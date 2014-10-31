<?php



class SalarioMinimoVigenteController extends \BaseController {

    protected $smv;

    /**
     * Constructor
     * @param Smv $smv
     */
    public function __construct(Smv $smv) {
        $this->smv = $smv;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $lista = Smv::all();
		return View::make('admin.smv.lista', ['lista' => $lista]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.smv.form', ['smv' => $this->smv]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->smv->create(Input::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $this->smv = Smv::find($id);
        return View::make('admin.smv.form', ['smv' => $this->smv]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $this->smv = Smv::find($id);
        $this->smv->update(Input::all());
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
