<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\State;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los estados por su nombre para asignar los IDs correctos
        $states = State::pluck('id', 'name')->toArray();

        $cities = [
            // AMAZONAS (ID: 1)
            'AMAZONAS' => [
                'PUERTO AYACUCHO',
                'SAN FERNANDO DE ATABAPO',
                'MAROA',
                'LA ESMERALDA'
            ],
            
            // ANZOÁTEGUI (ID: 2)
            'ANZOÁTEGUI' => [
                'BARCELONA',
                'PUERTO LA CRUZ',
                'EL TIGRE',
                'ANACO',
                'CANTARANA',
                'CLARINES',
                'GUANTA',
                'LECHERÍA',
                'PARIAGUÁN',
                'SOLEDAD',
                'SANTA ANA',
                'SANTA BÁRBARA',
                'SAN JOSÉ DE GUANIPA',
                'ARAGUA DE BARCELONA'
            ],
            
            // APURE (ID: 3)
            'APURE' => [
                'SAN FERNANDO DE APURE',
                'ACHAGUAS',
                'BIRUACA',
                'EL NULA',
                'GUASDUALITO',
                'MANTECAL',
                'SANTA BÁRBARA'
            ],
            
            // ARAGUA (ID: 4)
            'ARAGUA' => [
                'MARACAY',
                'TURMERO',
                'EL LIMÓN',
                'CAGUA',
                'LA VICTORIA',
                'SANTA CRUZ DE ARAGUA',
                'VILLA DE CURA',
                'PALO NEGRO',
                'CAMATAGUA',
                'SAN SEBASTIÁN',
                'LA COLONIA TOVAR',
                'SAN CASIMIRO'
            ],
            
            // BARINAS (ID: 5)
            'BARINAS' => [
                'BARINAS',
                'SOSA',
                'PEDRAZA',
                'ARISMENDI',
                'SANTA BÁRBARA',
                'CIUDAD BOLÍVIA',
                'EL REAL',
                'BARINITAS',
                'CALDERAS'
            ],
            
            // BOLÍVAR (ID: 6)
            'BOLÍVAR' => [
                'CIUDAD GUAYANA',
                'CIUDAD BOLÍVAR',
                'SAN FÉLIX',
                'PUERTO ORDAZ',
                'SANTA ELENA DE UAIRÉN',
                'UPATA',
                'EL CALLAO',
                'GUASIPATI',
                'TUMEREMO',
                'MARIPI'
            ],
            
            // CARABOBO (ID: 7)
            'CARABOBO' => [
                'VALENCIA',
                'GUACARA',
                'PUERTO CABELLO',
                'NIRGUA',
                'BEJUMA',
                'MARIARA',
                'EL PALITO',
                'MORÓN',
                'SAN JOAQUÍN',
                'TOCUYITO',
                'MONTALBÁN'
            ],
            
            // COJEDES (ID: 8)
            'COJEDES' => [
                'SAN CARLOS',
                'TINAQUILLO',
                'RICAURTE',
                'TINACO',
                'EL BAUL',
                'GIRARDOT'
            ],
            
            // DELTA AMACURO (ID: 9)
            'DELTA AMACURO' => [
                'TUCUPITA',
                'CIUDAD BOLÍVAR',
                'PEDERNALES',
                'PIACOA',
                'SAN JOSÉ DE AMACURO'
            ],
            
            // FALCÓN (ID: 10)
            'FALCÓN' => [
                'CORO',
                'PUNTO FIJO',
                'LOS TAQUES',
                'MENE DE MAUROA',
                'LA VELA DE CORO',
                'CHURUGUARA',
                'DABAJURO',
                'ADICORA',
                'SANTA ANA DE CORO',
                'JOSÉ LORENZO PÉREZ',
                'TUCACAS'
            ],
            
            // GUÁRICO (ID: 11)
            'GUÁRICO' => [
                'SAN JUAN DE LOS MORROS',
                'CALABOZO',
                'VALLE DE LA PASCUA',
                'ZARAZA',
                'EL CHARCOTE',
                'CAMAGUÁN',
                'SANTA MARÍA DE IPIRE',
                'EL SOMBRERO'
            ],
            
            // LA GUAIRA (ID: 12)
            'LA GUAIRA' => [
                'LA GUAIRA',
                'CATIA LA MAR',
                'MAIQUETÍA',
                'CARABALLEDA',
                'CARAYACA',
                'MACUTO',
                'CAMURÍ GRANDE'
            ],
            
            // LARA (ID: 13)
            'LARA' => [
                'BARQUISIMETO',
                'CABUDARE',
                'CARORA',
                'QUIBOR',
                'SANARE',
                'EL TOCUYO',
                'DUACA',
                'SARARE',
                'CUBIRO',
                'LOS CORTIJOS'
            ],
            
            // MÉRIDA (ID: 14)
            'MÉRIDA' => [
                'MÉRIDA',
                'EJIDO',
                'TABAY',
                'BAILADORES',
                'LA AZULITA',
                'EL CAMPITO',
                'SANTA CRUZ DE MORA',
                'CHIGUARÁ',
                'EL VIGÍA',
                'TUCANÍ',
                'PIEDRA DE MOLER',
                'MUCURUBÁ'
            ],
            
            // MIRANDA (ID: 15)
            'MIRANDA' => [
                'CARACAS',
                'LOS TEQUES',
                'CHARALLAVE',
                'GUARENAS',
                'CÚA',
                'OCOPITA',
                'SANTA TERESA DEL TUY',
                'SAN FRANCISCO DE YARE',
                'PETARE',
                'EL HATILLO',
                'BARUTA',
                'CHACAO',
                'SUCRE',
                'BALO',
                'SAN ANTONIO DE LOS ALTOS'
            ],
            
            // MONAGAS (ID: 16)
            'MONAGAS' => [
                'MATURÍN',
                'PUNTA DE MATA',
                'QUIRIQUIRE',
                'CARIPITO',
                'BARRA DEL GOLFO',
                'LA COSTA',
                'SABANA DE UCHIRE',
                'JOSÉ MARÍA BENÍTEZ',
                'TEREBÉN',
                'SANTA BÁRBARA'
            ],
            
            // NUEVA ESPARTA (ID: 17)
            'NUEVA ESPARTA' => [
                'LA ASUNCIÓN',
                'PORLAMAR',
                'PAMPATAR',
                'JUANGRIEGO',
                'PUNTA DE PIEDRAS',
                'EL CULEBRA',
                'EL YAQUE',
                'BOCA DEL RÍO',
                'SAN JUAN BAUTISTA'
            ],
            
            // PORTUGUESA (ID: 18)
            'PORTUGUESA' => [
                'GUANARE',
                'ACARIGUA',
                'VILA BRUZUAL',
                'TURÉN',
                'PAEZ',
                'ARAURE',
                'OSPININO',
                'SAN RAFAEL DE ONOTO'
            ],
            
            // SUCRE (ID: 19)
            'SUCRE' => [
                'CUMANÁ',
                'CARÚPANO',
                'GÜIRIA',
                'CASANAY',
                'MARIGÜITAR',
                'YAGUARAPARO',
                'IRAPA',
                'MANICUARE',
                'MUCURA',
                'BOLÍVAR',
                'ARAYA',
                'CHIPURÉ',
                'CUMANACOA'
            ],
            
            // TÁCHIRA (ID: 20)
            'TÁCHIRA' => [
                'SAN CRISTÓBAL',
                'TÁRIBAS',
                'RUBIO',
                'LA GRITA',
                'CAPACHO VIEJO',
                'CÓRDOBA',
                'MICHELENA',
                'LOBATERA',
                'SAN JOSÉ DE BOLÍVAR',
                'SANTIAGO DE MARIÑO',
                'EL COBRE',
                'LA CONCEPCIÓN',
                'URIBANTE'
            ],
            
            // TRUJILLO (ID: 21)
            'TRUJILLO' => [
                'TRUJILLO',
                'BOCONÓ',
                'MONTAÑA',
                'VALERA',
                'SAN RAFAEL DE CARVAJAL',
                'PAMPÁN',
                'BETIJOQUE',
                'CARACHE',
                'ESCUQUE',
                'SABANA DE MENDÉS',
                'SANTA APOLONIA',
                'CHIQUIMETAL',
                'BURBUSAY',
                'EL EJIDO'
            ]
        ];

        // Recorrer los estados y sus ciudades
        foreach ($cities as $stateName => $cityNames) {
            if (isset($states[$stateName])) {
                $stateId = $states[$stateName];
                
                foreach ($cityNames as $cityName) {
                    City::create([
                        'name' => $cityName,
                        'state_id' => $stateId,
                        'status' => 1
                    ]);
                }
            }
        }
    }
}