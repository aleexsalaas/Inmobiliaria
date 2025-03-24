<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Especificamos la tabla, si el nombre es diferente
    protected $table = 'users';

    // Los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Para la autenticación, si no usas el campo por defecto 'email', puedes especificar:
    protected $primaryKey = 'id';
    public $timestamps = true; // Esto es por si deseas que se usen los campos 'created_at' y 'updated_at'

    // No es necesario, pero puedes especificar que quieres usar el campo 'email' para la autenticación
    protected $guarded = []; // Si quieres proteger campos de asignación masiva, puedes agregar aquí

    // Puedes añadir los casts si tienes campos como booleanos, fechas, etc.
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // En el modelo User
public function isAdmin()
{
    return $this->role === 'admin';
}

}
