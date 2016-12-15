<?php

$this->layout('layout', ['title' => 'Librairies sur la métropole lilloise']) ?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href="<?php echo $this->assetUrl('css/libraries.css'); ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>
    <div id="app">
        <div class="libraries-list">
            <h2 v-show="libraries.length > 0">{{libraries.length}} librairies présentes sur la Métropole Européenne de Lille</h2>
            <ul>
                <li v-for="(library, index) of libraries">
                    <p>{{ library.fields.libelle }}
                        <br />{{ library.fields.adresse }}
                        <br />{{ library.fields.cp }} {{ library.fields.ville }}</p>
                    <button @click="situer(index)">Situer</button>
                </li>
            </ul>
        </div>
        <div id="map"></div>
    </div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?php echo $this->assetUrl('vendor/vue/dist/vue.min.js'); ?>"></script>
    <script src="<?php echo $this->assetUrl('vendor/axios/dist/axios.min.js'); ?>"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCv6a-YkF0e7UKVFqaw0-cvg3rMzjUyl60"></script>
    <script src="<?php echo $this->assetUrl('scripts/libraries.js'); ?>"></script>
<?php $this->stop('js') ?>