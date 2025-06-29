<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUpSertRequest;
use App\Jobs\DeleteCompletedTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    public function __construct(
        private Task $task
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Cache::has('data')) {
            return Cache::get('data');
        }

        $data =  $this->task->whereNull('deleted_at')->get();
        Cache::put('data', $data, 300);

        return $data;
    }

    /**
     * TaskUpSertRequest, request que faz validação do store e do update dependendo do método de endpoint disparado. Verificar TaskUpSertRequest
     */
    public function store(TaskUpSertRequest $request, $task = null)
    {
        $data = $request->validated();
        $task = $task ?: $this->task;

        if ($data['data_limite']) {
            $data['data_limite'] =  Carbon::parse(strtotime(str_replace('/', '-', $data['data_limite'])))->toDateTimeString();
        }

        unset($data['id']);
        $task->fill($data);

        try {
            /*
                Método save() do Laravel identifica se objeto é Novo/Existente, caso novo, aplica o create se não faz o update,
                dessa forma é feito reusabilidade de código
            */
            $task->save();
            Cache::forget('data');

            return response()->json(['status' => 'ok', 'data' => []]);
        } catch (\Throwable $e) {
            response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }

    /**
     * TaskUpSertRequest, request que faz validação do store e do update dependendo do método de endpoint disparado. Verificar TaskUpSertRequest
     */
    public function update(TaskUpSertRequest $request, string $id)
    {
        // Recupero o task pelo id
        $task = $this->task::firstOrNew(['id' => $id]);

        // Repassa o $request e o $task para o store, aplicando reusabilidade de código, tendo em vista que a lógica é a mesma
        return  $this->store($request, $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = $this->task::where('id', $id)->first();

        $task->delete();
        Cache::forget('data');
        DeleteCompletedTask::dispatch()->delay(now()->addSeconds(600));
    }
}
