<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUbicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubication_place', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('placeable_type');
            $table->integer('placeable_id');
            $table->timestamps();
        });

        //Enable PostGIS (as of 3.0 contains just geometry/geography)
        //  DB::statement('CREATE EXTENSION postgis'); --dont install if you have postgress-postgis extension
        //enable raster support (for 3+)
        DB::statement('CREATE EXTENSION postgis_raster');
        //Enable Topology
        //    DB::statement('CREATE EXTENSION postgis_topology');  --dont install if you have postgress-postgis extension
        /* Enable PostGIS Advanced 3D
            and other geoprocessing algorithms
            sfcgal not available with all distributions */
        DB::statement('CREATE EXTENSION postgis_sfcgal');
        //fuzzy matching needed for Tiger
        //    DB::statement('CREATE EXTENSION fuzzystrmatch'); --dont install if you have postgress-postgis extension
        //rule based standardizer
        DB::statement('CREATE EXTENSION address_standardizer');
        //example rule data set
        DB::statement('CREATE EXTENSION address_standardizer_data_us');
        //Enable US Tiger Geocoder
        //    DB::statement('CREATE EXTENSION postgis_tiger_geocoder'); --dont install if you have postgress-postgis extension
        //Upgrades postgis and other installed postgis packaged extensions
        DB::statement('SELECT postgis_extensions_upgrade()');



      






        DB::statement("SELECT AddGeometryColumn('public', 'ubication_place', 'geom', 4326, 'POINT', 2)");
        // Add a spatial index
        DB::statement('CREATE INDEX ubication_place_gix
            ON ubication_place
            USING GIST (geom);
            '); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Enable PostGIS (as of 3.0 contains just geometry/geography)
        DB::statement('DROP EXTENSION postgis');
        //enable raster support (for 3+)
        DB::statement('DROP EXTENSION postgis_raster');
        //Enable Topology
        DB::statement('DROP EXTENSION postgis_topology');
        /* Enable PostGIS Advanced 3D
         and other geoprocessing algorithms
         sfcgal not available with all distributions */
        DB::statement('DROP EXTENSION postgis_sfcgal');
        //fuzzy matching needed for Tiger
        DB::statement('DROP EXTENSION fuzzystrmatch');
        //rule based standardizer
        DB::statement('DROP EXTENSION address_standardizer');
        //example rule data set
        DB::statement('DROP EXTENSION address_standardizer_data_us');
        //Enable US Tiger Geocoder
        DB::statement('DROP EXTENSION postgis_tiger_geocoder');
        //Upgrades postgis and other installed postgis packaged extensions
        DB::statement('DROP postgis_extensions_upgrade()');

        Schema::dropIfExists('ubication_place');
    }
}
