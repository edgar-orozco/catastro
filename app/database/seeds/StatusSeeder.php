<?php
class StatusSeeder extends Seeder {
    public function run()
    {
        DB::table('cat_status')->delete();
        DB::table('cat_status')->insert(
            array('cve_status' => 'CI', 'descrip' => 'Carta Invitacion', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User' , 'dias_vigencia' => 15, 'notificacion' => 'No')
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'CI2', 'descrip' => 'Segunda Carta Invitacion', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User' , 'dias_vigencia' => 15, 'notificacion' => 'No')
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'RC', 'descrip' => 'Requerimiento Creado', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'RI', 'descrip' => 'Requerimiento Impreso', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'RA', 'descrip' => 'Requerimiento Asignado', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'RN', 'descrip' => 'Requerimiento Notificado', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'DC', 'descrip' => 'Determinacion Creada', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'DI', 'descrip' => 'Determinacion Impresa', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'DA', 'descrip' => 'Determinacion Asignada', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'DN', 'descrip' => 'Determinacion Notificada', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'EC', 'descrip' => 'Embargo Creado', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'EI', 'descrip' => 'Embargo Impreso', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'EA', 'descrip' => 'Embargo Asignado', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'EN', 'descrip' => 'Embargo Notificado', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'SS', 'descrip' => 'Proceso Suspendido', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'XE', 'descrip' => 'Embargo Ejecutado', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'XC', 'descrip' => 'Proceso Cancelado', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
        DB::table('cat_status')->insert(
            array('cve_status' => 'XP', 'descrip' => 'Pago Recibido', 'fecha_alta' => date("Y-m-d H:i:s"), 'usuario_alta' => 'User', 'dias_vigencia' => 15, 'notificacion' => 'No' )
        );
    }
}