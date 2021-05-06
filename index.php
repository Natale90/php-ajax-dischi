<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>php day 4</title>
    <!-- vue axios cdn -->
    <script src="https://cdn.jsdelivr.net/npm/axios@0.21.1/dist/axios.min.js"></script>
    <!-- vue cdn -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>


    <style media="screen">

      .container{
        width: 80%;
        margin: 100px auto;
        display: flex;
        flex-wrap: wrap;

      }

      .card{
        width: calc(100% / 5 - 20px);
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0px 10px 20px 10px;
        background-color: #1db954;
      }

      .card img{
        width: 200px;
        height: auto;
      }

    </style>
    <script type="text/javascript">


      function initVue(){

        new Vue({

          el: '#app',

          data:{

            collection: [],
            selectedGenre: null,
          },

          mounted(){

            axios.get('data.php', {

            })
            .then(r => {
              this.collection = r.data;

            })
            .catch(() => console.log('error'))
          },

          // methods:{
          //
          //   filtredByGenre: function(){
          //
          //     axios.get('data.php',{
          //
          //       params:{
          //         genre: this.selectedGenre,
          //       }
          //     })
          //
          //     .then(r => {
          //       this.collection = r.data;
          //
          //     })
          //
          //     .catch(() => console.log('error'))
          //   }
          //
          //
          // },//end of methods

          computed:{

            getMusicGenre: function(){
              let arrGenre = [];
              for(let i=0;i<this.collection.length; i++){

                let oneAlbum = this.collection[i];
                let genre = oneAlbum.genre;
                if(!arrGenre.includes(genre)){

                  arrGenre.push(genre);
                }
              };
              return arrGenre;
            },

          },//end of computed


        });


      };

      function init(){
        initVue();

      };
      document.addEventListener('DOMContentLoaded', init);


    </script>

  </head>
  <body>


    <!-- GOAL: Attraverso l'utilizzo di Axios: al caricamento
    della pagina axios chiederà attraverso una
    chiamata API i dischi a php e li stamperà
    attraverso vue. -->
    <div id='app'>

      <div class="selection">

        <label for="">seleziona un genere</label>
        <select v-model='selectedGenre' class="" name="">
          <option value=""></option>
          <option v-for='genre in getMusicGenre' :value="genre">{{genre}}</option>
        </select>

      </div>

      <div class="container">

        <div v-for='album in collection' class="card">
          <h3>{{album.title}}</h3>
          <p>
            {{album.author}}
          </p>
          <img :src="album.poster" alt="">
          <p>
            {{album.genre}}
          </p>
          <p>
            {{album.year}}
          </p>
        </div>

      </div>

    </div>

  </body>
</html>
