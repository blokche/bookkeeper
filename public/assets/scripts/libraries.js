var app = new Vue({
    el:"#app",
    data: {
        libraries:[],
        filterlibraries:[],
        loading:true,
        filter:null
    },
    methods:{
        situer: function (index)
        {
            let coords = this.filterlibraries[index].fields.geo_point_2d
            let info = this.filterlibraries[index].fields

            let resultsArea = document.querySelector('#app > div');
            let mapArea = document.querySelector('#map');

            let map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: coords[0], lng: coords[1]},
                zoom: 17
            });

            let marker = new google.maps.Marker({
                position: {lat:coords[0], lng:coords[1]},
                map: map,
                title: info.libelle
            });

            let infowindow = new google.maps.InfoWindow({
                content: "<p>"+info.libelle+"<hr />"+info.adresse+"<br />"+info.cp+" "+info.ville+"</p>"
            });

            marker.addListener('click', () => {
                infowindow.open(map, marker);
            });

            mapArea.classList.add('col-md-6');
            resultsArea.classList.add('col-md-6');
            mapArea.classList.add('embed-responsive-16by9');

            let position = document.querySelector('#map').getBoundingClientRect();
            window.scrollBy(0, position.top);

        },
        filterValue : function() {
            if (this.filter != null) {
                let filtre = new RegExp(this.filter, 'i');
                this.filterlibraries = this.libraries.filter( lib => filtre.test(lib.fields.ville )  || filtre.test(lib.fields.cp) )
            } else {
                this.filterlibraries = this.libraries
            }
        }
    },
    mounted () {
        axios.get('https://metropole-europeenne-de-lille.opendatasoft.com/api/records/1.0/search/?dataset=bibliotheques-mel&rows=120&facet=ville')
            .then(data => {
                this.libraries = data.data.records
                this.loading = false
                this.filterValue();
    })
    .catch( function(err) {
            console.error(err)
        })
    }
})