var app = new Vue({
    el:"#app",
    data: {
        libraries:[]
    },
    methods:{
        situer: function (index)
        {
            var coords = this.libraries[index].fields.geo_point_2d
            var info = this.libraries[index].fields
            var app = document.querySelector('#app');

            app.classList.add('mounted');

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: coords[0], lng: coords[1]},
                zoom: 10
            });

            var marker = new google.maps.Marker({
                position: {lat:coords[0], lng:coords[1]},
                map: map,
                title: info.libelle
            });

            var infowindow = new google.maps.InfoWindow({
                content: "<p>"+info.libelle+"<hr />"+info.adresse+"<br />"+info.cp+" "+info.ville+"</p>"
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });

        }
    },
    mounted () {
        axios.get('https://metropole-europeenne-de-lille.opendatasoft.com/api/records/1.0/search/?dataset=bibliotheques-mel&rows=120&facet=ville')
            .then(data => {
            this.libraries = data.data.records
    })
    .catch(err => {
            console.error(err)
    })
    }
})