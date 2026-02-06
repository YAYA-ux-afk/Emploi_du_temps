<?php
namespace App\Observers;

use App\Models\Course;
use App\Models\TimetableLog;

class CourseObserver
{
    /**
     * Gère l'événement "mis à jour" du cours.
     */
    public function updated(Course $course): void
    {
        // On récupère les colonnes qui ont changé
        $changes = $course->getChanges();
        
        // On récupère les valeurs avant la modification
        $oldValues = array_intersect_key($course->getOriginal(), $changes);

        // On enregistre dans ta table de suivi
        TimetableLog::create([
            'course_id'  => $course->id,
            'action'     => 'modification',
            'old_values' => json_encode($oldValues),
            'new_values' => json_encode($changes),
            'user_id'    => auth()->id() ?? 1, 
            'reason'     => request('reason', 'Modification d\'emploi du temps'),
        ]);
    }
}