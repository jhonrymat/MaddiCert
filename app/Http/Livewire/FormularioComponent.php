<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Solicitud;
use App\Models\Solicitante;
use App\Models\Tsolicitante;

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
    public $correo = '';
    public $genero = '';
    public $direccion = '';
    public $poblacion = '';
    public $ocupacion = '';
    public $escolaridad = '';
    public $fechaNacimiento = '';
    public $terminos = '';
    public $observaciones = '';
    public $anexos = '';

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
        'correo' => 'required|string|min:3',
        'genero' => 'required|string',
        'direccion' => 'required|string|min:3',
        'poblacion' => 'required|string',
        'ocupacion' => 'required|string',
        'escolaridad' => 'required|string',
        'fechaNacimiento' => 'required|string',
        'terminos' => 'required',
        'observaciones' => 'required|string',
        'anexos' => 'required|file|max:50240',
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
        'tipoIdentificacion.required' => 'El tipo de identificación es obligatorio.',
        'numeroIdentificacion.required' => 'El número de identificación es obligatorio.',
        'Expedicion.required' => 'El lugar de expedición es obligatorio.',
        'telefono.required' => 'El teléfono es obligatorio.',
        'correo.required' => 'El correo es obligatorio.',
        'genero.required' => 'El género es obligatorio.',
        'direccion.required' => 'La dirección es obligatoria.',
        'poblacion.required' => 'La población es obligatoria.',
        'ocupacion.required' => 'La ocupación es obligatoria.',
        'escolaridad.required' => 'El nivel de escolaridad es obligatorio.',
        'fechaNacimiento.required' => 'La fecha de nacimiento es obligatoria.',
        'terminos.required' => 'Debe aceptar los términos y condiciones.',
        'observaciones.required' => 'Las observaciones son obligatorias.',
        'anexos.required' => 'Los anexos son obligatorios.',
        'anexos.max' => 'Los anexos no deben superar los 50 MB.',
    ];

    public function save()
    {
        // Validar los datos del formulario
        $validatedData = $this->validate();

        // Manejo de la subida del archivo (anexo)
        if ($this->anexos) {
            $rutaArchivo = $this->anexos->store('anexos', 'public'); // Guardar archivo en 'storage/app/public/anexos'
            $evidenciaPDF = $rutaArchivo;
        } else {
            $evidenciaPDF = ''; // Manejo en caso de que no haya archivo
        }

        try {
            // Crear o actualizar el solicitante
            $solicitante = Solicitante::updateOrCreate(
                [
                    'numeroIdentificacion' => $this->numeroIdentificacion,
                ],
                [
                    'user_id' => auth()->id(),  // Se asume que el usuario está autenticado
                    'nombre_1' => $this->nombre1,
                    'nombre_2' => $this->nombre2,
                    'apellido_1' => $this->apellido1,
                    'apellido_2' => $this->apellido2,
                    'telefonoContacto' => $this->telefono,
                    'correoElectronico' => $this->correo,
                    'id_tipoSolicitante' => $this->tipoSolicitante,
                    'id_tipoDocumento' => $this->tipoIdentificacion,
                    'ciudadExpedicion' => $this->Expedicion,
                    'fechaNacimiento' => $this->fechaNacimiento,
                    'id_nivelEstudio' => $this->escolaridad,
                    'id_genero' => $this->genero,
                    'ocupacion' => $this->ocupacion,
                    'direccion' => $this->direccion,
                    'evidenciaPDF' => $evidenciaPDF,  // Guardar la ruta del archivo
                ]
            );

            // Crear una nueva solicitud
            Solicitud::create([
                'id_solicitante' => $solicitante->id,
                'numeroIdentificacion' => $this->numeroIdentificacion,
                'id_barrio' => 1, // Suponiendo que el barrio es 1, reemplazar con el valor real
                'direccion' => $this->direccion,
                'ubicacion' => 'N/A', // Reemplazar con los datos correspondientes
                'evidenciaPDF' => $evidenciaPDF,  // Guardar la ruta del archivo
            ]);

            // Mostrar mensaje de éxito
            session()->flash('message', 'Solicitud creada exitosamente.');

            // Reiniciar el formulario opcionalmente
            $this->reset();
            $this->openModal = false;  // Asegurarse de cerrar el modal si es necesario
        } catch (\Exception $e) {
            session()->flash('error', 'Error al guardar la solicitud: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $tipoSolicitantes = Tsolicitante::all();
        
        return view('livewire.formulario-component', [
            'tipoSolicitantes' => $tipoSolicitantes,
        ])->layout('layouts.tenancy');
    }
}