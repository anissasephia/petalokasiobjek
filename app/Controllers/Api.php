<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Tabledataobjek;

class Api extends ResourceController
{
    protected $tabledataobjek;

    public function __construct()
    {
        $this->tabledataobjek = new Tabledataobjek();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $dataobjek = $this->tabledataobjek->findAll();
        $feature = array();

        foreach ($dataobjek as $d) {
            $feature[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        floatval($d['longitude']),
                        floatval($d['latitude']),
                    ]
                ],
                'properties' => [
                    'id' => $d['id'],
                    'nama' => $d['nama'],
                    'deskripsi' => $d['deskripsi'],
                    'foto' => $d['foto'],
                ]
            ];
        }

        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => $feature
        );

        return $this->respond($geojson);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
