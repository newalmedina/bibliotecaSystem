<?php

use App\Autor;
use App\Editorial;
use App\Genero;
use Illuminate\Database\Seeder;
use App\Usuario;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class DatosPruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $autores = [
            'Gabriel García Márquez', 'Jane Austen', 'Harper Lee', 'George Orwell', 'Agatha Christie', 'F. Scott Fitzgerald', 'J.K. Rowling', 'Ernest Hemingway', 'Leo Tolstoy', 'J.R.R. Tolkien', 'Mark Twain', 'Virginia Woolf', 'Charles Dickens', 'Toni Morrison', 'Franz Kafka', 'Maya Angelou', 'Hermann Hesse', 'H.P. Lovecraft', 'Isabel Allende', 'Stephen King'
        ];

        foreach ($autores as $autor) {
            $newAutor = new Autor();
            $newAutor->nombre = $autor;
            $newAutor->save();
        }

        $editoriales = [
            'Penguin Random House',
            'HarperCollins',
            'Simon & Schuster',
            'Hachette Book Group',
            'Macmillan Publishers',
            'Scholastic',
            'Wiley',
            'Oxford University Press',
            'Cambridge University Press',
            'Pearson Education',
            'Elsevier',
            'Springer',
            'Pantheon Books',
            'Doubleday',
            'Vintage Books',
            'Bloomsbury Publishing',
            'Scholastic Corporation',
            'Houghton Mifflin Harcourt',
            'Abrams',
            'Alfred A. Knopf'
        ];

        foreach ($editoriales as $editorial) {
            $neweditorial = new Editorial();
            $neweditorial->nombre = $editorial;
            $neweditorial->save();
        }
        $generos = [
            'Novela',
            'Ciencia ficción',
            'Misterio',
            'Fantasía',
            'Romance',
            'Aventura',
            'Historia',
            'Biografía',
            'Ciencia',
            'Poesía',
            'Terror',
            'Thriller',
            'Drama',
            'Ciencia popular',
            'Ensayo',
            'Autoayuda',
            'Literatura infantil',
            'Literatura juvenil',
            'Ciencia política',
            'Filosofía'
        ];

        foreach ($generos as $genero) {
            $newgenero = new Genero();
            $newgenero->descripcion = $genero;
            $newgenero->save();
        }
    }
}
