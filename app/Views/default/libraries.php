<?php

$this->layout('layout', ['title' => 'Librairies sur la métropole lilloise']) ?>

<?php $this->start('css') ?>
    <style>
        [v-cloak] {
            opacity:0;
        }
        .libraries {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
        }
        .libraries li {
            flex:0 1 calc(50% - 20px);
            padding:10px;
            margin:10px;
            background:rgba(0,0,0,0.05);
        }
        .loader {
            margin:2em auto;
            display: inline-block;
            width:60px;
            height: 60px;
            border:5px solid transparent;
            border-top-color:rgba(64,64,64,0.8);
            border-radius:50%;
            vertical-align: middle;
            margin-right:1em;
            position: relative;
            -webkit-animation:rotation360 1.5s linear infinite;
            animation:rotation360 1.5s linear infinite;
        }

        .loader-triple:before, .loader-triple:after {
            content:"";
            display: inline-block;
            position: absolute;
            border-radius:50%;
        }

        .loader-triple:after {
            border:4px solid transparent;
            border-top-color:rgba(64,64,64,0.5);
            top:4px;
            left:4px;
            bottom:4px;
            right:4px;
            -webkit-animation:rotation360 2s linear infinite;
            animation:rotation360 2s linear infinite;
        }

        .loader-triple:before {
            border:3px solid transparent;
            border-top-color:rgba(64,64,64,0.5);
            top:13px;
            left:13px;
            bottom:13px;
            right:13px;
            -webkit-animation:rotation360 1s linear infinite;
            animation:rotation360 1s linear infinite;
        }

        @-webkit-keyframes rotation360 {
            0% {
                -webkit-transform:rotate(0deg);
                transform:rotate(0deg);
            }
            100% {
                -webkit-transform:rotate(360deg);
                transform:rotate(360deg);
            }
        }

        @keyframes rotation360 {
            0% {
                -webkit-transform:rotate(0deg);
                transform:rotate(0deg);
            }
            100% {
                -webkit-transform:rotate(360deg);
                transform:rotate(360deg);
            }
        }
    </style>
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

    <ol class="breadcrumb">
        <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
        <li class="active">Librairies sur la métropole lilloise</li>
    </ol>

    <div id="app">
        <div v-cloak v-show="libraries.length" class="libraries-list col-sm-12 col-md-6">
            <div>
                <h2>{{libraries.length}} librairies présentes sur la Métropole Européenne de Lille</h2>
                <div class="form-group">
                    <label for="filter">Filtrer les résultats par ville</label>
                    <input id="filter" class="form-control" @keyup.enter="filterValue" v-model="filter" type="search" placeholder="Filtrer les résultats" />
                </div>
                <ul class="libraries">
                    <li v-for="(library, index) of filterlibraries">
                        <p><strong>{{ library.fields.libelle }}</strong>
                            <br />{{ library.fields.adresse }}
                            <br />{{ library.fields.cp }} {{ library.fields.ville }}</p>
                        <button class="btn btn-sm btn-default" @click="situer(index)">Situer</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-12" v-if="loading">
            <span class="loader loader-triple"></span>
            <p>Patience. Nous récupérons la liste des bibliothèques présentes sur la métropole lilloise...</p>
        </div>
        <div id="map" class="col-sm-12 col-md-6 embed-responsive embed-responsive-16by9"></div>
    </div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?php echo $this->assetUrl('vendor/vue/dist/vue.min.js'); ?>"></script>
    <script src="<?php echo $this->assetUrl('vendor/axios/dist/axios.min.js'); ?>"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCv6a-YkF0e7UKVFqaw0-cvg3rMzjUyl60"></script>
    <script src="<?php echo $this->assetUrl('scripts/libraries.js'); ?>"></script>
<?php $this->stop('js') ?>