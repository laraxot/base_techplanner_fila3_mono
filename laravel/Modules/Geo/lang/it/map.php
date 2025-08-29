<?php

return array (
  'navigation' => 
  array (
    'name' => 'Mappe',
    'plural' => 'Mappe',
    'group' => 
    array (
      'name' => 'Geo',
      'description' => 'Gestione e visualizzazione delle mappe',
    ),
    'label' => 'Mappe',
    'sort' => 33,
    'icon' => 'geo-map',
  ),
  'fields' => 
  array (
    'title' => 'Titolo',
    'type' => 'Tipo Mappa',
    'zoom_level' => 'Livello Zoom',
    'center_lat' => 'Latitudine Centro',
    'center_lng' => 'Longitudine Centro',
    'markers' => 'Marcatori',
    'layers' => 'Livelli',
    'style' => 'Stile',
    '_tpl' => 
    array (
      'description' => '_tpl',
      'helper_text' => '_tpl',
      'placeholder' => '_tpl',
      'label' => '_tpl',
    ),
    'text' => 
    array (
      'description' => 'text',
      'helper_text' => 'text',
      'placeholder' => 'text',
      'label' => 'text',
    ),
  ),
  'map_types' => 
  array (
    'roadmap' => 'Stradale',
    'satellite' => 'Satellite',
    'hybrid' => 'Ibrida',
    'terrain' => 'Terreno',
  ),
  'controls' => 
  array (
    'zoom' => 'Zoom',
    'pan' => 'Panoramica',
    'fullscreen' => 'Schermo Intero',
    'streetview' => 'Street View',
    'layers' => 'Livelli',
  ),
  'actions' => 
  array (
    'add_marker' => 'Aggiungi Marcatore',
    'draw_polygon' => 'Disegna Poligono',
    'measure_distance' => 'Misura Distanza',
    'export' => 'Esporta',
  ),
);
