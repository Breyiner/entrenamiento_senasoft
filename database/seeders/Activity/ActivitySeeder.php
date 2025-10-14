<?php

namespace Database\Seeders\Activity;

use App\Models\Activity\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $activities = [
      [
        'name' => 'Evaluación de riesgos laborales',
        'description' => 'Identificación y evaluación de riesgos presentes en el área de trabajo.',
      ],
      [
        'name' => 'Elaboración de plan de seguridad',
        'description' => 'Desarrollo del plan de seguridad para mitigar riesgos identificados.',
      ],
      [
        'name' => 'Capacitación en seguridad',
        'description' => 'Formación y entrenamiento al personal en normas y prácticas de seguridad.',
      ],
      [
        'name' => 'Simulacro de evacuación',
        'description' => 'Realización de simulacros para la evacuación de emergencia.',
      ],
      [
        'name' => 'Inspección de equipos',
        'description' => 'Revisión y mantenimiento preventivo de equipos de seguridad.',
      ],
      [
        'name' => 'Reporte de accidente laboral',
        'description' => 'Documentación y análisis de incidentes ocurridos en el trabajo.',
      ],
      [
        'name' => 'Auditoría de cumplimiento normativo',
        'description' => 'Evaluación del cumplimiento de reglamentaciones y normas SST.',
      ],
    ];

    foreach ($activities as $activity) {
      Activity::create($activity);
    }
  }
}
