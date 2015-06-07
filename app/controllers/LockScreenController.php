<?php
/**
 * Created by David
 */
class LockScreenController extends BaseController
{
    /**
     * Obtiene el tiempo que se mantiene activa la sesion
     * @return \Illuminate\View\View
     */
    public function session()
    {
        return array(
            'session'    => Config::get('session.lifetime'),
        );
    }
}