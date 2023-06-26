<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {

            $events = Event::where([
                // busca por eventos que o titulo contenha algo
                ['title', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $events = Event::all();
        }


        return view('welcome', ['events' => $events, 'search' => $search]);
    }
    public function create()
    {
        return view('events.create');
    }
    public function store(Request $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // upload de image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;
            // pega a extensão do arquivo
            $extension = $requestImage->extension();
            // pega o nome original da imagem e  criptografado em md5 e concatena com o tempo de agora mais a extensão do arquivo
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            //slva a imagem no servidor 
            $requestImage->move(public_path('img/events'), $imageName);
            // salva nome da imagem no banco de dados
            $event->image = $imageName;
        }

        //pega o id do usuario logado
        $user = auth()->user();
        $event->user_id = $user->id;
        $event->save();

        // após salvar redireciona o usuario para a home novamente
        // redireciona sem mensagem para a pagina home
        // return redirect('/');
        // redireciona com mensagem para a home
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }
    public function show($id)
    {
        // passa o id para a consulta
        $event = Event::findOrFail($id);
        $user = auth()->user();
        $hasUserJoined = false;
        if ($user){

            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                    break;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        // retorna os dados para um view
        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard()
    {
        $user = auth()->user();
// manda para a viwe os eventos em que ele é dono
        $events = $user->events;
        // manda para a view os eventos em que ele participa
        $eventsAsParticipant = $user->eventsAsParticipant;



        return view('events.dashboard', ['events' => $events, 'eventsasparticipant'=>$eventsAsParticipant]);
    }
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento Excluido com sucesso!');
    }
    public function edit($id)
    {
        $user = auth()->user();
        // passa o id para a consulta
        $event = Event::findOrFail($id);
        if($user->id != $event->user_id){
            return redirect('/dashboard');
        }
        return view('events.edit',['event' => $event]);
    }
    public function update(Request $request){   
        $data = $request->all();

                // upload de image
                if ($request->hasFile('image') && $request->file('image')->isValid()) {

                    $requestImage = $request->image;
                    // pega a extensão do arquivo
                    $extension = $requestImage->extension();
                    // pega o nome original da imagem e  criptografado em md5 e concatena com o tempo de agora mais a extensão do arquivo
                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
                    //slva a imagem no servidor 
                    $requestImage->move(public_path('img/events'), $imageName);
                    // salva nome da imagem no banco de dados
                    $data['image'] = $imageName;
                }
        // ele vai pegar o id vindo do request, e usar ele para fazer o updte no registro usando o all
        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg','Dados editado com sucesso!');


    }
    public function joinEvent($id){
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg','Sua presença esta confirmada no evento '. $event->title);
    }
    public function leaveEvent($id){
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg','Presença removida do evento '. $event->title);
    }
}
