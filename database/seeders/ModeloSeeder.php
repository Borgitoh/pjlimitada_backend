<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;
use App\Models\Modelo;

class ModeloSeeder extends Seeder
{
    public function run()
    {
        // Array de modelos por marca
        $modelos = [
            'Toyota' => [
                'Corolla', 'Hilux', 'Camry', 'Yaris', 'Fortuner', 'RAV4', 'Land Cruiser', 'Vios', 'Avanza', 'Sienna', 'Tacoma', 'Sequoia', 'Supra', 'Mirai', 'C-HR'
            ],
            'BMW' => [
                'X5', 'M3', 'M4', 'X3', 'X6', 'Z4', 'i8', 'M5', '3 Series', '7 Series', 'X7', 'X1', 'M2', '5 Series', 'i4'
            ],
            'Mercedes-Benz' => [
                'A-Class', 'C-Class', 'E-Class', 'S-Class', 'GLC', 'GLA', 'AMG GT', 'CLA', 'B-Class', 'GLS', 'EQB', 'SLC', 'V-Class', 'SL', 'G-Class'
            ],
            'Audi' => [
                'A3', 'A4', 'A5', 'A6', 'Q5', 'Q7', 'Q8', 'RS7', 'A7', 'TT', 'R8', 'S4', 'S5', 'S6', 'SQ5'
            ],
            'Hyundai' => [
                'Elantra', 'Santa Fe', 'Tucson', 'Sonata', 'Kona', 'Ioniq', 'Palisade', 'Nexo', 'Veloster', 'Kona EV', 'Kona Hybrid', 'Tucson Hybrid', 'Ioniq 5', 'Ioniq 6', 'Creta'
            ],
            'Volkswagen' => [
                'Golf', 'Passat', 'Jetta', 'Polo', 'Tiguan', 'Touareg', 'Up!', 'Arteon', 'ID.4', 'ID.3', 'Transporter', 'Amarok', 'Caddy', 'Sharan', 'Beetle'
            ],
            'Kia' => [
                'Sportage', 'Seltos', 'Telluride', 'Forte', 'Optima', 'Stinger', 'Soul', 'Niro', 'K900', 'Cadenza', 'Sorento', 'KX5', 'Xceed', 'Tucson', 'Carnival'
            ],
            'Ford' => [
                'Mustang', 'Focus', 'Fiesta', 'Fusion', 'Escape', 'Explorer', 'Ranger', 'F-150', 'Bronco', 'Maverick', 'Edge', 'Expedition', 'Mustang Mach-E', 'Super Duty', 'Transit'
            ],
            'Chevrolet' => [
                'Camaro', 'Malibu', 'Cruze', 'Impala', 'Equinox', 'Traverse', 'Blazer', 'Tahoe', 'Suburban', 'Silverado', 'Colorado', 'Sonic', 'Bolt EV', 'Spark', 'Trax'
            ],
            'Nissan' => [
                'Altima', 'Maxima', '370Z', 'Leaf', 'Sentra', 'Rogue', 'Murano', 'Pathfinder', 'Armada', 'Titan', 'Frontier', 'Juke', 'NV3500', 'Kicks', 'Xterra'
            ],
            'Dodge' => [
                'Charger', 'Challenger', 'Durango', 'Ram 1500', 'Jeep Grand Cherokee', 'Jeep Compass', 'Jeep Wrangler', 'Jeep Renegade', 'Jeep Gladiator', 'Jeep Cherokee', 'Dodge Journey', 'Dodge Dart', 'Viper', 'SRT', 'Ram 2500'
            ],
            'Cadillac' => [
                'Escalade', 'XT5', 'XT6', 'CT6', 'CTS', 'ATS', 'XTS', 'SRX', 'STS', 'Cadillac V', 'Esv', 'LTS', 'ATS-V', 'CT5', 'CT4'
            ],
            'Jeep' => [
                'Wrangler', 'Grand Cherokee', 'Cherokee', 'Renegade', 'Compass', 'Gladiator', 'Liberty', 'Commander', 'Patriot', 'Wagoneer', 'Cherokee Trailhawk', 'Grand Cherokee L', 'Grand Cherokee Summit', 'Cherokee Latitude', 'Cherokee Overland'
            ],
            'Jetour' => [
                'Dashing', 'X70', 'X90', 'X95', 'X55', 'T70', 'S70', 'Sport', 'Grand Jetour', 'Jetour T60', 'Jetour X70 PLUS', 'Jetour X80', 'Jetour X30', 'Jetour X90 EV', 'Jetour E5'
            ],
            'Suzuki' => [
                'Swift', 'Vitara', 'Baleno', 'S-Cross', 'Jimny', 'Grand Vitara', 'Celerio', 'Alto', 'Ertiga', 'Wagon R', 'SX4', 'Kizashi', 'Liana', 'Ignis', 'Splash'
            ],
            'Lexus' => [
                'RX', 'ES', 'NX', 'GS', 'LS', 'UX', 'LC', 'LX', 'IS', 'RC', 'RX L', 'GX', 'CT', 'LF-A', 'LS F Sport'
            ],
            'Mazda' => [
                'CX-5', 'Mazda 3', 'Mazda 6', 'MX-5 Miata', 'CX-9', 'CX-3', 'CX-30', 'Mazda 2', 'Mazda 2 Hybrid', 'Mazda 5', 'Mazda RX-8', 'Mazda CX-7', 'Mazda 6 Wagon', 'Mazda MX-30', 'Mazda BT-50'
            ],
            'Mitsubishi' => [
                'Outlander', 'Eclipse Cross', 'Lancer', 'Pajero', 'Mirage', 'ASX', 'Montero', 'L200', 'Galant', 'Pajero Sport', 'Shogun', 'Space Star', 'Delica', 'i-MiEV', 'Mitsubishi 380'
            ],
            'Fiat' => [
                'Punto', '500', 'Panda', 'Tipo', 'Doblo', 'Qubo', '500L', '500X', 'Freemont', 'Pajero', 'Punto Evo', 'Stilo', 'Bravo', 'Linea', 'Spider'
            ],
            'GMC' => [
                'Sierra', 'Yukon', 'Canyon', 'Acadia', 'Terrain', 'GMC Sierra 1500', 'GMC Sierra HD', 'GMC Terrain EV', 'GMC Hummer EV', 'Canyon AT4', 'GMC Savana', 'GMC Envoy', 'GMC Jimmy', 'Savana 2500', 'Sierra Denali'
            ]
        ];

        foreach ($modelos as $marcaNome => $nomes) {
            $marca = Marca::where('nome', $marcaNome)->first();
            if ($marca) {
                foreach ($nomes as $nome) {
                    $ano = rand(1995, 2025); 
                    Modelo::create([
                        'nome' => $nome,
                        'marca_id' => $marca->id,
                        'year' => $ano
                    ]);
                }
            }
        }
    }
}
