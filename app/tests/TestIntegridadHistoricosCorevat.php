<?php
/**
 * Realiza test de integridad para los registros históricos del corevat
 */
class TestIntegridadHistoricosCorevat extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();

        //hacemos login como admin
        $admin = User::where('username','admin')->first();
        $this->be($admin);
    }

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'local';

        return require __DIR__.'/../../bootstrap/start.php';
    }


    public function testEsMostrableElAvaluoAlConsultar(){

        //Secciones del avaluo
        $secciones = ['General', 'Zona', 'Inmueble', 'EnfoqueMercado', 'EnfoqueFisico', 'Conclusiones', 'Fotos'];
        //Consultamos todos los avalúos

        //$avaluos = Avaluos::take(3)->orderBy('idavaluo')->get();
        $avaluos = Avaluos::all();

        foreach($avaluos as $avaluo) {
            foreach($secciones as $seccion) {
                $url = '/corevat/Avaluo' . $seccion . '/' . $avaluo->idavaluo;
                $crawler = $this->client->request('GET', $url);
                $res = $this->client->getResponse()->isOk();
                if(!$res)
                {
                    print "\n === Error en: ".$url;
                }
                $this->assertTrue( $res );

            }
        }
    }

}
