<?php
/**
 * @author "Navid Moeini"
 * @date May 2018
 */

namespace App\Services;


interface ServiceInterface
{

    public function create();

    public function show($id);

    public function update($id);

    public function destroy($id);

}