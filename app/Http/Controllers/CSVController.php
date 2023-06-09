<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CSVController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function __invoke(Request $request)
    {
        $file = fopen('file.csv', 'w');

        fputcsv($file, ['id', 'name', 'course', 'score', 'expert']);

        User::query()
        ->with('courses' /* '.experts' *)
        ->chunk(10, function (Collection $users) use ($file) {
            foreach ($users as $user) {
                foreach ($user->courses as $course) {
                    foreach ($course->experts as $expert) {
                        fputcsv($file, [
                            $user->id,
                            $user->name,
                            $course->name,
                            $course->inNumber,
                            $expert->name,
                        ]);
                    }
                }
            }
        });

        fclose($file);

        /* return response()->download($file, headers: [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ExportFileName.csv"',
        ]); *
    } */

    public function __invoke()
    {
        $file = fopen('file.csv', 'w');

        fputcsv($file, collect(
            ['id', 'name']
        )->merge(
            Expert::query()->has('courses')->get()->pluck('name')->merge(['kbk'])
        )->toArray()
        );

        User::query()->with('courses.experts')
        ->chunk(10, function (Collection $users) use ($file) {
            foreach ($users as $user) {
                fputcsv(
                    $file,
                    collect([$user->id, $user->name])
                    ->merge($user->userExpertise())
                    ->toArray()
                );
            }
        });

        fclose($file);
    }
}
