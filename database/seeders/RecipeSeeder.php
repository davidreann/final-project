<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = [

            [
                'title' => 'Chicken Wings',
                'category' => 'appetizer',
                'ingredients' => "Chicken wings\nSauce\nSpices",
                'steps' => "Fry wings\nToss in sauce",
                'image' => 'https://t3.ftcdn.net/jpg/02/91/35/16/360_F_291351654_FFAS60r2iHUkOY69RPRwEOVS76EU4SdA.jpg?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Mango Float',
                'category' => 'dessert',
                'ingredients' => "Mango\nCream\nGraham crackers",
                'steps' => "Layer ingredients\nChill",
                'image' => 'https://www.simplyrecipes.com/thmb/1OuJ0T1LN-I5W930_MYnWLo7U_Q=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Simply-Recipes-Mango-Float-LEAD-5-def4352d032943b58aa349c46f275483.jpg?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Bruschetta',
                'category' => 'appetizer',
                'ingredients' => "Bread\nTomatoes\nGarlic\nOlive oil",
                'steps' => "Toast bread\nTop with mixture",
                'image' => 'https://images.unsplash.com/photo-1506280754576-f6fa8a873550?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Garlic Rice',
                'category' => 'side_dish',
                'ingredients' => "Rice\nGarlic\nOil",
                'steps' => "Saute garlic\nAdd rice",
                'image' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Chicken Adobo',
                'category' => 'main_dish',
                'ingredients' => "Chicken\nSoy sauce\nVinegar\nGarlic\nBay leaves\nPeppercorns",
                'steps' => "Marinate chicken\nSimmer with sauce\nReduce until tender",
                'image' => 'https://thumbs.dreamstime.com/b/pork-adobo-19171223.jpg?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Beef Tapa',
                'category' => 'main_dish',
                'ingredients' => "Beef slices\nSoy sauce\nGarlic\nSugar\nPepper",
                'steps' => "Marinate beef\nPan-fry until browned",
                'image' => 'https://images.unsplash.com/photo-1672106629973-04c87c79855b?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Spaghetti Bolognese',
                'category' => 'main_dish',
                'ingredients' => "Spaghetti\nGround beef\nTomato sauce\nOnion\nGarlic",
                'steps' => "Cook pasta\nSimmer sauce\nCombine",
                'image' => 'https://images.unsplash.com/photo-1645453015291-0a80bbdeeea6?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Grilled Chicken Breast',
                'category' => 'main_dish',
                'ingredients' => "Chicken breast\nOlive oil\nSalt\nPepper",
                'steps' => "Season chicken\nGrill until cooked",
                'image' => 'https://www.budgetbytes.com/wp-content/uploads/2024/06/Grilled-Chicken-V1.jpeg?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Pork Sinigang',
                'category' => 'main_dish',
                'ingredients' => "Pork\nTamarind mix\nVegetables\nFish sauce",
                'steps' => "Boil pork\nAdd vegetables\nAdd tamarind mix",
                'image' => 'https://thumbs.dreamstime.com/b/pork-sinigang-26721355.jpg?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Garlic Butter Shrimp',
                'category' => 'main_dish',
                'ingredients' => "Shrimp\nButter\nGarlic\nLemon",
                'steps' => "Saute garlic\nAdd shrimp\nAdd butter",
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSuGMGQYgsUSmKL4aV2MwHw2J8-__zEvaN7Sw&s?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Fried Chicken',
                'category' => 'main_dish',
                'ingredients' => "Chicken\nFlour\nEgg\nOil\nSpices",
                'steps' => "Coat chicken\nDeep fry until golden",
                'image' => 'https://st.depositphotos.com/1005891/2309/i/450/depositphotos_23093506-stock-photo-fried-chicken-on-square-white.jpg?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Lumpiang Shanghai',
                'category' => 'appetizer',
                'ingredients' => "Ground pork\nWrapper\nCarrots\nGarlic",
                'steps' => "Wrap filling\nDeep fry",
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxFWonZqUYkCe4cMwoLLntzl4yESEbuLpllw&s?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Caesar Salad',
                'category' => 'appetizer',
                'ingredients' => "Lettuce\nCroutons\nDressing\nParmesan",
                'steps' => "Mix all ingredients",
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Mozzarella Sticks',
                'category' => 'appetizer',
                'ingredients' => "Mozzarella\nBreadcrumbs\nEgg",
                'steps' => "Coat cheese\nDeep fry",
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/005/926/136/small/breaded-mozzarella-cheese-sticks-served-with-tomato-sauce-photo.JPG?auto=format&fit=crop&w=600&q=80',
            ],

            [
                'title' => 'Chocolate Cake',
                'category' => 'dessert',
                'ingredients' => "Flour\nCocoa\nSugar\nEggs",
                'steps' => "Mix batter\nBake",
                'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Leche Flan',
                'category' => 'dessert',
                'ingredients' => "Eggs\nMilk\nSugar",
                'steps' => "Caramelize sugar\nSteam mixture",
                'image' => 'https://thumbs.dreamstime.com/b/leche-flan-sweet-cream-caramel-42001524.jpg?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Banana Split',
                'category' => 'dessert',
                'ingredients' => "Banana\nIce cream\nChocolate syrup",
                'steps' => "Assemble ingredients",
                'image' => 'https://www.shutterstock.com/image-photo/banana-split-sundae-served-scoops-600nw-2539026775.jpg?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Mashed Potatoes',
                'category' => 'side_dish',
                'ingredients' => "Potatoes\nButter\nMilk",
                'steps' => "Boil potatoes\nMash",
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmVSKTHO1fv4H-9c4ISLfTDvUNrqGHayQAfw&s?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'title' => 'Coleslaw',
                'category' => 'side_dish',
                'ingredients' => "Cabbage\nCarrots\nDressing",
                'steps' => "Mix ingredients",
                'image' => 'https://thumbs.dreamstime.com/b/homemade-fresh-creamy-coleslaw-salad-shredded-cabbage-carrots-purple-onion-435752645.jpg?auto=format&fit=crop&w=600&q=80',
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create([
                'user_id' => rand(1, 5),
                'title' => $recipe['title'],
                'description' => 'A flavorful and satisfying dish perfect for any occasion.',
                'ingredients' => $recipe['ingredients'],
                'steps' => $recipe['steps'],
                'closing' => 'Enjoy your meal!',
                'prep_time' => rand(10, 30),
                'is_draft' => false,
                'image' => $recipe['image'],
                'category' => $recipe['category'],
            ]);
        }
    }
}