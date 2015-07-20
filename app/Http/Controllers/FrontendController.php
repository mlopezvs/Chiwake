<?php namespace Chiwake\Http\Controllers;

use Illuminate\Http\Request;

use Chiwake\Repositories\AboutRepo;
use Chiwake\Repositories\MenuRepo;
use Chiwake\Repositories\MenuCategoryRepo;
use Chiwake\Repositories\PhraseRepo;
use Chiwake\Repositories\StaffRepo;

class FrontendController extends Controller {

    protected $aboutRepo;
    protected $menuRepo;
    protected $menuCategoryRepo;
    protected $phraseRepo;
    protected $staffRepo;

    public function __construct(AboutRepo $aboutRepo,
                                MenuRepo $menuRepo,
                                MenuCategoryRepo $menuCategoryRepo,
                                PhraseRepo $phraseRepo,
                                StaffRepo $staffRepo)
    {
        $this->aboutRepo = $aboutRepo;
        $this->menuRepo = $menuRepo;
        $this->menuCategoryRepo = $menuCategoryRepo;
        $this->phraseRepo = $phraseRepo;
        $this->staffRepo = $staffRepo;
    }


	public function home()
	{
        $frases = $this->phraseRepo->publicadoOrden('titulo', 'asc');
        $about = $this->aboutRepo->findOrFail(1);

		return view('frontend.home', compact('frases', 'about'));
	}

    public function nosotros()
    {
        $frases = $this->phraseRepo->publicadoOrden('titulo', 'asc');
        $staff = $this->staffRepo->publicadoOrden('orden', 'asc');
        $about = $this->aboutRepo->findOrFail(1);

        return view('frontend.nosotros', compact('frases', 'staff', 'about'));
    }

    public function menu()
    {
        $menus_categories = $this->menuCategoryRepo->publicadoOrden('orden', 'asc');
        $menus = $this->menuRepo->orderBy('titulo', 'asc')->get();

        return view('frontend.menu', compact('menus_categories', 'menus'));
    }

    public function reservacion()
    {
        $mensaje = null;

        return view('frontend.reservacion', compact('mensaje'));
    }

    public function reservacionForm()
    {
        $data = [
            'nombre' => Input::get('nombre'),
            'apellidos' => Input::get('apellidos'),
            'email' => Input::get('email'),
            'telefono' => Input::get('telefono'),
            'fecha' => Input::get('fecha'),
            'hora' => Input::get('hora'),
            'personas' => Input::get('personas'),
        ];

        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'personas' => 'required|min:1|max:100'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes())
        {
            $fromEmail = 'marco@minduck.com';
            $fromNombre = 'Marco Lopez';

            Mail::send('emails.frontend.reservacion', $data, function($message) use ($fromNombre, $fromEmail){
                $message->to($fromEmail, $fromNombre);
                $message->from($fromEmail, $fromNombre);
                $message->subject('Chiwake - Reservación');
            });

            $mensaje = '<div class="alert notification alert-success">Tu mensaje ha sido enviado.</div>';

            return view('frontend.reservacion', compact('mensaje'));
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }
    }

    public function contacto()
    {
        $mensaje = null;
        return view('frontend.contacto', compact('mensaje'));
    }

    public function contactoForm()
    {
        $data = [
            'mensaje' => Input::get('mensaje'),
            'nombre' => Input::get('nombre'),
            'email' => Input::get('email')
        ];

        $rules = [
            'mensaje' => 'required',
            'nombre' => 'required',
            'email' => 'required|email'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes())
        {
            $fromEmail = 'marco@minduck.com';
            $fromNombre = 'Marco Lopez';

            Mail::send('emails.frontend.contacto', $data, function($message) use ($fromNombre, $fromEmail){
                $message->to($fromEmail, $fromNombre);
                $message->from($fromEmail, $fromNombre);
                $message->subject('Chiwake - Contacto');
            });
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }

        $mensaje = 'Tu mensaje ha sido enviado.';

        if(Request::ajax())
        {
            return $mensaje;
        }
    }

}
