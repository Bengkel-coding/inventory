<?php

use Illuminate\Database\Seeder;


class MenuSeed extends Seeder
{
         
    public function run()
    {
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Event',
                'controller'    => '#',
                'slug'          => 'event',
                'order'         => 2,
            ],[]);
        
        \trinata::addMenu([ 
                    'parent_id'     => 'event',
                    'title'         => 'Daftar Event',
                    'controller'    => 'EventController',
                    'slug'          => 'event-list',
                    'order'         => 2,
                ],['index','create','update','delete']
        ); 

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Pengumuman',
                'controller'    => '#',
                'slug'          => 'pengumuman',
                'order'         => 3,
            ],[]);

        \trinata::addMenu([ 
                'parent_id'     => 'pengumuman',
                'title'         => 'Daftar Pengumuman',
                'controller'    => 'PengumumanController',
                'slug'          => 'pengumuman-list',
                'order'         => 3,
            ],['index','create','update','delete']
        );

        // \trinata::addMenu([ 
        //         'parent_id'     => null,
        //         'title'         => 'Forum Umum',
        //         'controller'    => '#',
        //         'slug'          => 'forum-umum',
        //         'order'         => 4,
        //     ],[]);


        
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Knowledge',
                'controller'    => '#',
                'slug'          => 'knowledge',
                'order'         => 5,
            ],[]);
        
        \trinata::addMenu([ 
                    'parent_id'     => 'knowledge',
                    'title'         => 'Daftar Knowledge',
                    'controller'    => 'KnowledgeController',
                    'slug'          => 'knowledge-list',
                    'order'         => 5,
                ],['index','create','update','delete']
        );

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Tapkin',
                'controller'    => 'TakpinController',
                'slug'          => 'tapkin',
                'order'         => 6,
            ],['index','create','update','delete']
        );

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Eksternal Link',
                'controller'    => 'EksternalLinkController',
                'slug'          => 'eksternal-link',
                'order'         => 7,
            ],['index','create','update','delete']
        );

        

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Division',
                'controller'    => 'DivisionController',
                'slug'          => 'division',
                'order'         => 15,
            ],['index','create','update','delete']
        );


        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Inventaris',
                'controller'    => '#',
                'slug'          => 'inventaris',
                'order'         => 8,
            ],['index','create','update','delete']
        );

        \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'Daftar Barang Inventaris',
                    'controller'    => 'InventarisController',
                    'slug'          => 'inventaris-list',
                    'order'         => '1'
                ],['index','create','update','publish','delete']
        ); 

        \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'Daftar Permintaan Peminjaman',
                    'controller'    => 'PermintaanController',
                    'slug'          => 'permintaan-list',
                    'order'         => '1'
                ],['index','create','update','delete']
        ); 

        \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'Daftar Peminjaman',
                    'controller'    => 'PeminjamanController',
                    'slug'          => 'peminjaman-list',
                    'order'         => '2'
                ],['index','create','update','delete']
        ); 
		
        \trinata::addMenu([ 
                    'parent_id'     => 'inventaris',
                    'title'         => 'Daftar Pengembalian',
                    'controller'    => 'PengembalianController',
                    'slug'          => 'pengembalian-list',
                    'order'         => '3'
                ],['index','create','update','delete']
        );

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Forum Group',
                'controller'    => '#',
                'slug'          => 'forum-group',
                'order'         => 9,
            ],['index','create','update','delete']
        );

        \trinata::addMenu([ 
                    'parent_id'     => 'forum-group',
                    'title'         => 'Daftar Group',
                    'controller'    => 'ForumGroupController',
                    'slug'          => 'forum-group-list',
                    'order'         => '1'
                ],['index','create','update','delete']
        );

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Berkas Digital',
                'controller'    => '#',
                'slug'          => 'berkas-digital',
                'order'         => 7,
            ],['index','create','update','delete']
        );

        \trinata::addMenu([ 
                'parent_id'     => 'berkas-digital',
                'title'         => 'Berkas Folder',
                'controller'    => 'BerkasFolderController',
                'slug'          => 'berkas-folder',
                'order'         => 1,
            ],['index','create','update','delete','publish']
        );

        \trinata::addMenu([ 
                'parent_id'     => 'berkas-digital',
                'title'         => 'Berkas Repo',
                'controller'    => 'BerkasReposController',
                'slug'          => 'berkas-repos',
                'order'         => 1,
            ],['index','create','update','delete','publish']
        );

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Forum Umum BSN',
                'controller'    => '#',
                'slug'          => 'forum-bsn',
                'order'         => 10,
            ],['index','create','update','delete']
        );

        \trinata::addMenu([ 
                    'parent_id'     => 'forum-bsn',
                    'title'         => 'Daftar Thread',
                    'controller'    => 'ForumUmumThreadController',
                    'slug'          => 'forum-bsn-thread',
                    'order'         => '1'
                ],['index','create','update','delete']
        );

    }
}
