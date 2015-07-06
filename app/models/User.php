<?php


use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;
use Observers\UserObserver;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;

    protected $fillable = ['username', 'email', 'password', 'nombre', 'apepat', 'apemat', 'roles', 'municipios', 'notarias', 'vigente', 'rfc', 'curp'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Many-to-Many relación con Municipios
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function municipios()
    {
        return $this->belongsToMany('Municipio', 'user_municipio', 'usuario_id', 'municipio_id')->withTimestamps();
    }

    /**
     * Many-to-Many relación con Notarias
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notarias()
    {
        return $this->belongsToMany('Notaria', 'notaria_usuario', 'user_id', 'notaria_id')->withTimestamps();
    }

    /**
     * Función para enchufar eventos
     */
    public static function boot()
    {
        parent::boot();

        // Se enchufa el observer
        User::observe(new UserObserver);
    }

    /**
     * Get user by username
     * @param $username
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return $this->where('username', '=', $username)->first();
    }

    /**
     * Get the date the user was created.
     *
     * @return string
     */
    public function joined()
    {
        return String::date(Carbon::createFromFormat('Y-n-j G:i:s', $this->created_at));
    }

    /**
     * Save roles inputted from multiselect
     * @param $inputRoles
     */
    public function saveRoles($inputRoles)
    {
        if (!empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }
    /**
     * Save municipios inputted from multiselect
     * @param $inputMunicipios
     */
    public function saveMunicipios($inputMunicipios)
    {
        if (!empty($inputMunicipios)) {
            $this->municipios()->sync($inputMunicipios);
        }
    }

    /**
     * Returns user's current role ids only.
     * @return array|bool
     */
    public function currentRoleIds()
    {
        $roles = $this->roles;
        $roleIds = false;
        if (!empty($roles)) {
            $roleIds = array();
            foreach ($roles as &$role) {
                $roleIds[] = $role->id;
            }
        }
        return $roleIds;
    }

    /**
     * Declaramos un mutador para el campo nombre
     * @param $valor
     */
    public function setNombreAttribute($valor)
    {
        $this->attributes['nombre'] = mb_strtoupper($valor);
    }

    /**
     * Declaramos un mutador para el campo apepat
     * @param $valor
     */
    public function setApepatAttribute($valor)
    {
        $this->attributes['apepat'] = mb_strtoupper($valor);
    }

    /**
     * Declaramos un mutador para el campo apemat
     * @param $valor
     */
    public function setApematAttribute($valor)
    {
        $this->attributes['apemat'] = mb_strtoupper($valor);
    }

    /**
     * Declaramos un mutador para el campo username
     * @param $valor
     */
    public function setUsernameAttribute($valor)
    {
        $this->attributes['username'] = mb_strtolower($valor);
    }

    /**
     * Regresa una cadena con el nombre completo del usuario con el orden Nombre, Paterno, Materno (NPM) o con el orden PMN
     * @param string $orden
     * @return string
     */
    public function nombreCompleto($orden = 'NPM')
    {

        $nombreCompleto = [];
        if ($orden == 'NPM') {
            $nombreCompleto[] = $this->nombre;
            $nombreCompleto[] = $this->apepat;
            $nombreCompleto[] = $this->apemat;
        } else {
            $nombreCompleto[] = $this->apepat;
            $nombreCompleto[] = $this->apemat;
            $nombreCompleto[] = $this->nombre;
        }
        return implode(" ", $nombreCompleto);
    }

    /**
     * Funcion para regresar la cadena solo con los apellidos de un usurio
     * @return string
     */
    public function apellidos(){
        return $this->apepat.' '.$this->apemat;
    }

    /**
     * Funcion para regresar la lista de los municipos a los que pertenece un usuario
     * @return array|string
     */
    public function municipiosPertenece(){
        $municipios = array();
        if(count($this->municipios) > 0){
            foreach($this->municipios as $municipio){
                $municipios[] = $municipio->nombre_municipio;
            }
        }
        else{
            $municipios[] = 'Todos';
        }
        return $municipios;
    }

    /**
     * Funcion para crear el arreglo de datos que espera procesar angular
     * @return array
     */
    public function listAngular(){
        $users = array();
        foreach($this->with('roles')->with('municipios')->get() as $user){
            $users[] = array(
                'id'             => $user->id,
                'username'       => $user->username,
                'email'          => $user->email,
                'nombre'         => $user->nombre,
                'apepat'         => $user->apepat,
                'apemat'         => $user->apemat,
                'nombreCompleto' => $user->nombreCompleto(),
                'roles'          => $user->roles,
                'municipios'     => $user->municipios,
                'vigente'        => $user->vigente
            );
        }
        return $users;

    }

    /**
     * Funcion para crear el arreglo de datos que espera procesar angular
     * @return array
     */
    public function listAngularNotarias(){
        $users = array();
        $lista = $this->whereHas( 'roles' , function($q){
                $q->where('name', '=', 'Usuario de Notaría');
            })
            ->with('roles')
            ->with('notarias')
            ->get();
        foreach( $lista as $user){
            $users[] = array(
                'id'             => $user->id,
                'username'       => $user->username,
                'email'          => $user->email,
                'nombre'         => $user->nombre,
                'apepat'         => $user->apepat,
                'apemat'         => $user->apemat,
                'nombreCompleto' => $user->nombreCompleto(),
                'curp'           => $user->curp ?: '' ,
                'rfc'            => $user->rfc ?: '',
                'roles'          => $user->roles,
                'notarias'       => $user->notarias,
                'vigente'        => $user->vigente,
                'municipio'      => $user->notarias()->first()->mpio->nombre_municipio,
                'estado'         => $user->notarias()->first()->estado->nom_ent
            );
        }
        return $users;

    }
    /**
     * Funcion para crear el arreglo de datos que espera procesar angular
     * @return array
     */
    public function datosProfile(){
        $roles = array();
        foreach($this->with('roles')->get() as $rol){
            $roles[] = $rol->id;
        }
        return htmlspecialchars(json_encode(array(
                'id'             => $this->id,
                'username'       => $this->username,
                'email'          => $this->email,
                'nombre'         => $this->nombre,
                'apepat'         => $this->apepat,
                'apemat'         => $this->apemat,
                //'roles'          => $roles
            )), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Devuelve el numero total de usuarios registrados
     * @return int
     */
    public static function totalUsers()
    {
        return self::all()->count();
    }


    /**
     * Regresa un arregla con los ids de los roles.
     * @return array
     */
    public function roleIdArray(){
        $roles = $this->roles;
        $rids = array();
        if(count($roles) > 0){
            foreach($roles as $rol) {
                $rids[] = $rol->id;
            }
        }
        return $rids;
    }

    /**
     * Regresa un arreglo de ids de municipios a los que pertenece el usuario.
     * @return array
     */
    public function municipioIdArray(){
        $municipios = $this->municipios;
        $mids = array();
        if(count($municipios) > 0){
            foreach($municipios as $municipio){
                $mids[] = $municipio->municipio;
            }
        }
        return $mids;
    }


    /**
     * Checa si el usuario tiene un rol dado el id del rol
     *
     * @param string $id Role id.
     *
     * @return bool
     */
    public function hasRoleId($id)
    {
        foreach ($this->roles as $role) {
            if ($role->id == $id) {
                return true;
            }
        }

        return false;
    }


    public function tramites(){
        return $this->hasMany('Tramite', 'usuario_id', 'id' );
    }

}
