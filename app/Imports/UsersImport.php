<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use DB;

// class UsersImport implements WithMappedCells, ToModel 
class UsersImport implements ToCollection, WithHeadingRow {
	public $skipped = [];
	
	function headingRow(): int {
		return 1;
	}

	function parseDate($date) {
		try{
			$c = Carbon::createFromFormat("d/m/Y",$date);
		}catch(\Exception $e){
			$c = Carbon::parse($date);
		}

		return $c->format("Y-m-d");
	}

	function collection(Collection $rows) {
		$user = auth()->user();
		$pw = User::defaultPassword();
		try{
			DB::beginTransaction();
			foreach ($rows as $row) {
				// preson($row);
				$hasEmptyEss = empty($row['name']) || empty($row['email']) || empty($row['username']);
				if($hasEmptyEss){
					$this->skipped[] = $row;
					continue;
				}

				$user = User::create([
					'name' => $row['name'],
					'email' => $row['email'],
					'username' => $row['username'],
					'password' => $pw,
					'role' => 'member',
					'by_id' => $user->id,
					'is_active' => 1,
				]);

				$weight = $row['weight'];
				$height = $row['height'];
				$bsa = User::calcBSA($weight, $height);
				$bmi = UserProfile::calcBMI($weight, $height);

				$dob = $row['birth_at'];

				$bsa = User::calcBSA($weight, $height);
				// $birthDate = Carbon::parse($dob);
				$birthDate = $this->parseDate($dob);
				$today = Carbon::now();
				$age = $today->diffInYears($birthDate);
	
				$dp = [
					"address" => $row["address"],
					"birth_at" => $birthDate,
					"phone" => $row["phone"],
					"weight" => $weight,
					"height" => $height,
					"age" => $age,
					"bsa" => $bsa,
					"bmi" => $bmi,
				];
				$profile = $user->profile()->create($dp);
			}
			DB::commit();
		}catch(\Exception $e){
			DB::rollback();
			throw $e;
		}
	}

	/**
	 * Get the value of skipped
	 */ 
	public function getSkipped()
	{
		return $this->skipped;
	}

	/**
	 * Set the value of skipped
	 *
	 * @return  self
	 */ 
	public function setSkipped($skipped)
	{
		$this->skipped = $skipped;

		return $this;
	}
}
