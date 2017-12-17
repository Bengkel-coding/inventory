<?php

use Illuminate\Database\Seeder;


class MenuSeed extends Seeder
{
    /* example add menu
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Management product',
                'controller'    => '#',
                'slug'          => 'product',
                'order'         => 1,
            ],[]);

                \trinata::addMenu([ 
                    'parent_id'     => 'product',
                    'title'         => 'Category',
                    'controller'    => 'CategoryController',
                    'slug'          => 'category',
                    'order'         => '1'
                ],['index','create','update','delete']
            ); 

    */
   

         
    public function run()
    {
        //
        //
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Material',
                'controller'    => '#',
                'slug'          => 'material',
                'order'         => 1,
            ],[]);

                \trinata::addMenu([ 
                    'parent_id'     => 'material',
                    'title'         => 'MRO',
                    'controller'    => 'Material\MaterialMroController',
                    'slug'          => 'material-mro',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                \trinata::addMenu([ 
                    'parent_id'     => 'material',
                    'title'         => 'MRO - ABT',
                    'controller'    => 'Material\MaterialMroAbtController',
                    'slug'          => 'material-mro-abt',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'material',
                    'title'         => 'Investasi',
                    'controller'    => 'Material\MaterialInvestasiController',
                    'slug'          => 'material-investasi',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'material',
                    'title'         => 'Eks - Jaringan',
                    'controller'    => 'Material\MaterialEksJaringanController',
                    'slug'          => 'material-eks-jaringan',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'material',
                    'title'         => 'Tercatat ',
                    'controller'    => 'Material\MaterialTercatatController',
                    'slug'          => 'material-tercatat',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Mutasi Gudang',
                'controller'    => '#',
                'slug'          => 'mutasi',
                'order'         => 1,
            ],[]);


                \trinata::addMenu([ 
                    'parent_id'     => 'mutasi',
                    'title'         => 'MRO',
                    'controller'    => 'Mutasi\MutasiMroController',
                    'slug'          => 'mutasi-mro',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                \trinata::addMenu([ 
                    'parent_id'     => 'mutasi',
                    'title'         => 'MRO - ABT',
                    'controller'    => 'Mutasi\MutasiMroAbtController',
                    'slug'          => 'mutasi-mro-abt',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'mutasi',
                    'title'         => 'Investasi',
                    'controller'    => 'Mutasi\MutasiInvestasiController',
                    'slug'          => 'mutasi-investasi',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'mutasi',
                    'title'         => 'Eks - Jaringan',
                    'controller'    => 'Mutasi\MutasiEksJaringanController',
                    'slug'          => 'mutasi-eks-jaringan',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'mutasi',
                    'title'         => 'Tercatat ',
                    'controller'    => 'Mutasi\MutasiTercatatController',
                    'slug'          => 'mutasi-tercatat',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Pemanfaatan',
                'controller'    => '#',
                'slug'          => 'pemanfaatan',
                'order'         => 1,
            ],[]);


                \trinata::addMenu([ 
                    'parent_id'     => 'pemanfaatan',
                    'title'         => 'MRO',
                    'controller'    => 'Pemanfaatan\PemanfaatanMroController',
                    'slug'          => 'pemanfaatan-mro',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                \trinata::addMenu([ 
                    'parent_id'     => 'pemanfaatan',
                    'title'         => 'MRO - ABT',
                    'controller'    => 'Pemanfaatan\PemanfaatanMroAbtController',
                    'slug'          => 'pemanfaatan-mro-abt',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'pemanfaatan',
                    'title'         => 'Investasi',
                    'controller'    => 'Pemanfaatan\PemanfaatanInvestasiController',
                    'slug'          => 'pemanfaatan-investasi',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'pemanfaatan',
                    'title'         => 'Eks - Jaringan',
                    'controller'    => 'Pemanfaatan\PemanfaatanEksJaringanController',
                    'slug'          => 'pemanfaatan-eks-jaringan',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'pemanfaatan',
                    'title'         => 'Tercatat ',
                    'controller'    => 'Pemanfaatan\PemanfaatanTercatatController',
                    'slug'          => 'pemanfaatan-tercatat',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Pengembalian',
                'controller'    => '#',
                'slug'          => 'pengembalian',
                'order'         => 1,
            ],[]);


                \trinata::addMenu([ 
                    'parent_id'     => 'pengembalian',
                    'title'         => 'MRO',
                    'controller'    => 'Pengembalian\PengembalianMroController',
                    'slug'          => 'pengembalian-mro',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                \trinata::addMenu([ 
                    'parent_id'     => 'pengembalian',
                    'title'         => 'MRO - ABT',
                    'controller'    => 'Pengembalian\PengembalianMroAbtController',
                    'slug'          => 'pengembalian-mro-abt',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'pengembalian',
                    'title'         => 'Investasi',
                    'controller'    => 'Pengembalian\PengembalianInvestasiController',
                    'slug'          => 'pengembalian-investasi',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Inventarisasi Rekonsiliasi',
                'controller'    => '#',
                'slug'          => 'inventaris',
                'order'         => 1,
            ],[]);


                \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'MRO',
                    'controller'    => 'Inventaris\InventarisMroController',
                    'slug'          => 'inventaris-mro',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'MRO - ABT',
                    'controller'    => 'Inventaris\InventarisMroAbtController',
                    'slug'          => 'inventaris-mro-abt',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'Investasi',
                    'controller'    => 'Inventaris\InventarisInvestasiController',
                    'slug'          => 'inventaris-investasi',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'Eks - Jaringan',
                    'controller'    => 'Inventaris\InventarisEksJaringanController',
                    'slug'          => 'inventaris-eks-jaringan',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
                
                \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'Tercatat ',
                    'controller'    => 'Inventaris\InventarisTercatatController',
                    'slug'          => 'inventaris-tercatat',
                    'order'         => '1'
                ],['index','create','update','delete','publish']
            ); 
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Laporan',
                'controller'    => '#',
                'slug'          => 'laporan',
                'order'         => 1,
            ],[]);
    }
}
