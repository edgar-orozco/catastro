<?php


use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;

    protected $fillable = ['username', 'email', 'password', 'nombre', 'apepat', 'apemat', 'roles', 'municipios'];

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
     * Many-to-Many relacion con Municipios
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function municipios()
    {
        return $this->belongsToMany('Municipio', 'user_municipio', 'usuario_id', 'municipio_id');
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
                $municipios[] = $municipio->nom_mpo;
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
        foreach($this->all() as $user){
            $users[] = array(
                'id'             => $user->id,
                'username'       => $user->username,
                'email'          => $user->email,
                'nombre'         => $user->nombre,
                'apepat'         => $user->apepat,
                'apemat'         => $user->apemat,
                'nombreCompleto' => $user->nombreCompleto(),
                'roles'          => $user->roles
            );
        }
        return $users;

    }

    /**
     * Devuelve el numero total de usuarios registrados
     * @return int
     */
    public static function totalUsers()
    {
        return self::all()->count();
    }

}
