<?php

namespace App\Http\Livewire;

use App\Models\Genero;
use Livewire\Component;
use App\Models\Nestudio;
use App\Models\Solicitud;
use App\Models\Tdocumento;
use App\Models\Solicitante;
use App\Models\Tsolicitante;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class FormularioComponent extends Component
{
    use WithFileUploads;

    public $openModal = false; // Inicializar $openModal como false
    public $tipoViaPrimaria = '';
    public $numeroViaPrincipal = '';
    public $letraViaPrincipal = '';
    public $bis = '';
    public $letraBis = '';
    public $cuadranteViaPrincipal = '';
    public $numeroViaGeneradora = '';
    public $letraViaGeneradora = '';
    public $numeroPlaca = '';
    public $cuadranteViaGeneradora = '';
    public $direccionGenerada = '';
    public $complemento = '';
    public $otro = '';

    public $nombre1 = '';
    public $nombre2 = '';
    public $apellido1 = '';
    public $apellido2 = '';
    public $tipoIdentificacion = '';
    public $numeroIdentificacion = '';
    public $Expedicion = '';
    public $tipoSolicitante = '';
    public $telefono = '';
    public $genero = '';
    public $direccion = '';
    public $poblacion = '';
    public $ocupacion = '';
    public $escolaridad = '';
    public $fechaNacimiento = '';
    public $terminos = '';
    public $observaciones = '';
    public $anexos = '';
    public $correoElectronico = '';



    protected $rules = [
        'nombre1' => 'required|string|min:3',
        'nombre2' => 'required|string|min:3',
        'apellido1' => 'required|string|min:3',
        'apellido2' => 'required|string|min:3',
        'tipoSolicitante' => 'required|string',
        'tipoIdentificacion' => 'required|string',
        'numeroIdentificacion' => 'required|string',
        'Expedicion' => 'required|string',
        'telefono' => 'required|string|min:3',
        'genero' => 'required|string',
        'direccion' => 'required|string|min:3',
        'poblacion' => 'required|string',
        'ocupacion' => 'required|string',
        'escolaridad' => 'required|string',
        'fechaNacimiento' => 'required|string',
        'terminos' => 'required',
        'observaciones' => 'required|string',
        'correoElectronico' => 'required|email',
        'anexos' => 'required|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240',
    ];
    protected $messages = [
        'nombre1.required' => 'El primer nombre es obligatorio.',
        'nombre1.min' => 'El primer nombre debe tener al menos 3 caracteres.',

        'nombre2.required' => 'El segundo nombre es obligatorio.',
        'nombre2.min' => 'El segundo nombre debe tener al menos 3 caracteres.',

        'apellido1.required' => 'El primer apellido es obligatorio.',
        'apellido1.min' => 'El primer apellido debe tener al menos 3 caracteres.',

        'apellido2.required' => 'El segundo apellido es obligatorio.',
        'apellido2.min' => 'El segundo apellido debe tener al menos 3 caracteres.',

        'tipoSolicitante.required' => 'El tipo de solicitante es obligatorio.',
        'tipoSolicitante.min' => 'El tipo de solicitante debe tener al menos 3 caracteres.',

        'tipoIdentificacion.required' => 'El tipo de identificación es obligatorio.',
        'tipoIdentificacion.min' => 'El tipo de identificación debe tener al menos 3 caracteres.',

        'numeroIdentificacion.required' => 'El número de identificación es obligatorio.',
        'numeroIdentificacion.min' => 'El número de identificación debe tener al menos 3 caracteres.',

        'Expedicion.required' => 'El lugar de expedición es obligatorio.',
        'Expedicion.min' => 'El lugar de expedición debe tener al menos 3 caracteres.',

        'telefono.required' => 'El teléfono es obligatorio.',
        'telefono.min' => 'El teléfono debe tener al menos 3 caracteres.',

        'genero.required' => 'El género es obligatorio.',
        'genero.min' => 'El género debe tener al menos 3 caracteres.',

        'direccion.required' => 'La dirección es obligatoria.',
        'direccion.min' => 'La dirección debe tener al menos 3 caracteres.',


        'poblacion.required' => 'La población es obligatoria.',
        'poblacion.min' => 'La población debe tener al menos 3 caracteres.',

        'ocupacion.required' => 'La ocupación es obligatoria.',
        'ocupacion.min' => 'La ocupación debe tener al menos 3 caracteres.',

        'escolaridad.required' => 'El nivel de escolaridad es obligatorio.',
        'escolaridad.min' => 'El nivel de escolaridad debe tener al menos 3 caracteres.',

        'fechaNacimiento.required' => 'La fecha de nacimiento es obligatoria.',
        'fechaNacimiento.min' => 'La fecha de nacimiento debe tener al menos 3 caracteres.',

        'terminos.required' => 'Debe aceptar los términos y condiciones.',
        'terminos.min' => 'El campo de términos debe tener al menos 3 caracteres.',

        'observaciones.required' => 'Las observaciones son obligatorias.',
        'observaciones.min' => 'Las observaciones deben tener al menos 3 caracteres.',

        'anexos.required' => 'Los anexos son obligatorios.',
    ];



    public function save()
    {
        // Validate form data
        $validatedData = $this->validate();



        // First, create or update the solicitante
        $solicitante = Solicitante::Create([
                'user_id' => auth()->id(),  // Assuming you have the user ID
                'nombre_1' => $this->nombre1,
                'nombre_2' => $this->nombre2,
                'apellido_1' => $this->apellido1,
                'apellido_2' => $this->apellido2,
                'telefonoContacto' => $this->telefono,
                'correoElectronico' => $this->correoElectronico,
                'numeroIdentificacion' => $this->numeroIdentificacion,
                'id_tipoSolicitante' => $this->tipoSolicitante,
                'id_tipoDocumento' => $this->tipoIdentificacion,
                'ciudadExpedicion' => $this->Expedicion,
                'fechaNacimiento' => $this->fechaNacimiento,
                'id_nivelEstudio' => $this->escolaridad,
                'id_genero' => $this->genero,
                'ocupacion' => $this->ocupacion,
            ]
        );

        if ($this->anexos) {
            $link = Storage::put('anexos', $this->anexos);
         }
        // Create a new solicitud
        Solicitud::create([
            'id_solicitante' => $solicitante->id,
            'numeroIdentificacion' => $this->numeroIdentificacion,
            'id_barrio' => 1, // Assuming barrio is 1 for now, replace with actual value
            'direccion' => $this->direccion,
            'ubicacion' => 'N/A', // Replace with actual data if applicable
            'evidenciaPDF' => $link ?? '',  // Handle file uploads separately
        ]);

        // Show success message
        session()->flash('message', 'Solicitud creada exitosamente.');

        // Optionally, reset the form
        $this->reset();
    }



    public function render()
    {
        $tipoSolicitantes = Tsolicitante::all();
        $tipoDocumentos = Tdocumento::all();
        $nivelEstudios = Nestudio::all();
        $nombreGeneros = Genero::all();

        return view('livewire.formulario-component', [
            'tipoSolicitantes' => $tipoSolicitantes,
            'tipoDocumentos' => $tipoDocumentos,
            'nivelEstudios' => $nivelEstudios,
            'nombreGeneros' => $nombreGeneros,
        ])->layout('layouts.tenancy');
    }
}
