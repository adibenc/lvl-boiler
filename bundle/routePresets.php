<?php

// include(__DIR__."/../app/dummycommon.php");

if(!function_exists("resourceCrud")){
    function resourceCrud($namePrefix, $class){
        Route::get("/", [$class, "index"])->name("$namePrefix.index");
        Route::get("/create", [$class, "create"])->name("$namePrefix.create");
        Route::post("/", [$class, "store"])->name("$namePrefix.store");
        Route::get("/{id}", [$class, "show"])->name("$namePrefix.show");
        Route::get("/{id}/edit", [$class, "edit"])->name("$namePrefix.edit");
        Route::patch("/{id}", [$class, "update"])->name("$namePrefix.update");
        Route::post("/update/{id}", [$class, "update"])->name("$namePrefix.update");
        Route::delete("/{id}", [$class, "destroy"])->name("$namePrefix.destroy");
    }
}

if(!function_exists("resourceCrudWithPrefix")){
    // ->middleware("admin")
    function resourceCrudWithPrefix($prefix, $namePrefix, $class){
        Route::group(['prefix' => $prefix], function () use ($prefix, $namePrefix, $class) {
            resourceCrud($namePrefix, $class);
        });
    }
}

if(!function_exists("datatableRoute")){
    function datatableRoute($name, $class){
        // preout(["data/$name", [$class, "get"]]);
        Route::get("data/$name", [$class, "get"])->name("admin.$name.datatable");
        Route::get("data/$name/where", [$class, "where"])->name("admin.$name.datatable.where");
    }
}