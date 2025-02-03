<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    private $preFixedNames = [
        'Loja do ',
        'Padaria do ',
        'Lancheria do ',
        'Padaria do ',
        'Mercado do ',
    ];

    private $names = [
        "Bolo de Chocolate",
        "Pão Integral",
        "Suco de Laranja",
        "Leite Integral",
        "Café Torrado",
        "Chocolate ao Leite",
        "Biscoito Recheado",
        "Margarina Sem Sal",
        "Queijo Mussarela",
        "Iogurte Natural",
        "Arroz Branco",
        "Feijão Carioca",
        "Macarrão Espaguete",
        "Molho de Tomate",
        "Extrato de Tomate",
        "Azeite Extra Virgem",
        "Vinagre de Maçã",
        "Sabonete Líquido",
        "Shampoo",
        "Condicionador",
        "Creme Dental",
        "Escova de Dentes",
        "Desodorante",
        "Perfume",
        "Creme Hidratante",
        "Protetor Solar",
        "Sabonete em Barra",
        "Gel de Banho",
        "Loção Corporal",
        "Papel Higiênico",
        "Toalha de Papel",
        "Detergente Líquido",
        "Esponja de Cozinha",
        "Limpa Vidros",
        "Desinfetante",
        "Água Sanitária",
        "Cereal Matinal",
        "Bolo de Fubá",
        "Pipoca de Micro-ondas",
        "Biscoito de Água e Sal",
        "Café Solúvel",
        "Chá de Camomila",
        "Achocolatado",
        "Manteiga",
        "Refrigerante",
        "Sopa Instantânea",
        "Iogurte Grego",
        "Granola Natural",
        "Bebida Energética",
        "Água Mineral"
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(User::query()->orderBy('id', 'asc')->value('id'), User::query()->orderBy('id', 'desc')->value('id')-1),
            'product' => json_encode(
                [
                    "nome" => $this->faker->randomElement($this->names),
                    "descricao" => $this->faker->text(254),
                    "tipo" => "Alimento",
                    "categoria" => "Doces",
                    "marca" => $this->faker->randomElement($this->preFixedNames) . $this->faker->name('male'),
                    "modelo" => "Tradicional",
                    "validade" => $this->faker->dateTimeBetween('-3 months', '+3 months'),
                    "data_fabricacao" => $this->faker->dateTimeBetween('-3 months', 'yesterday'),
                    "preco" => $this->faker->randomFloat(2),
                    "estoque" => $this->faker->numberBetween(0, 50),
                    "dimensoes" => [
                        "altura" => $this->faker->numberBetween(5, 100) . "cm",
                        "largura" => $this->faker->numberBetween(5, 100) . "cm",
                        "profundidade" => $this->faker->numberBetween(5, 100) . "cm"
                    ],
                    "peso" => $this->faker->numberBetween(100, 950) . 'g',
                    "status" => $this->faker->randomElement(["ativo", "inativo"]),
                ]
            ),
            'updated_at' => $this->faker->dateTimeBetween('-3 months'),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }
}
