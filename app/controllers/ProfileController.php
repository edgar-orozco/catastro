<?php
/**
 * Created by David
 */
class ProfileController extends BaseController
{

    /**
     * Muestra la pantalla de consulta de profile.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Title
        $title = "Mis datos";
        // Title
        $title_section = "Mis datos";

        return View::make('profile.index', compact('title', 'title_section'));
    }
    /**
     * Muestra la pantalla de consulta de profile.
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Title
        $title = "Mis datos";
        // Title
        $title_section = "Mis datos";
        // Subtitle
        $subtitle_section = "Modificar datos";

        return View::make('profile.edit', compact('title', 'title_section', 'subtitle_section'));
    }
}