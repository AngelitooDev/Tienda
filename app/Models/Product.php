<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use hasFactory;
    protected $fillable = [
        'type', 'name', 'description', 'stock', 'weight', 'image'
    ];

    /**
     * Devuelve las categorías disponibles en el enum.
     *
     * @return array
     */
    public static function getCategories(): array
    {
        return ['Armas cortas', 'Cuchillos', 'Armas largas'];
    }
}
