<template>
    <v-layout row>
        <v-flex xs12 sm6>
           <div class="conteneurGeneral" id="conteneurGeneral">
             <v-card>
               <v-toolbar class="conteneurChat" color="light-blue darken-1" @click="quitChat">
                  <v-toolbar-title><span class="titleChat">Chat</span></v-toolbar-title>
               </v-toolbar>

                 <div class="conteneurMessages">
                   <v-list two-line>
                       <template v-for="(item, index) in items">
                           <div avatar ripple :key="index">

                              <!-- Si le message précédent est du même auteur-->
                              <div class="leMess plsMess"  v-if="index!=0 && items[index-1].username==item.username ">
                                 <span class="contenuTxt">{{ item.message }}</span>
                              </div>

                              <!-- Sinon -->
                              <div v-else>
                                 <!-- Si c'est la premier message pas de marge au dessus du nom de l'auteur -->
                                 <div v-if="index!==0" class="conteneurAuteur">
                                    <span class="auteur">{{ item.username }}</span>
                                 </div>
                                 <!-- Si c'est pas le premier message, marge au dessus-->
                                 <div v-else>
                                    <span class="auteur">{{ item.username }}</span>
                                 </div>

                                 <div class="leMess">
                                    <span class="contenuTxt">{{ item.message }}</span>
                                 </div>
                              </div>
                           </div>
                        </template>
                   </v-list>
                </div>
               <div class="conteneurInput" @keyup.enter="sendMessage">
                  <v-text-field class="inputEcrire" color="grey" style="padding:0" name="input-1" v-model="messChat" multi-line></v-text-field>
               </div>
            </v-card>
           </div>
           <div class="chatCache" id="btnOpenChat" @click="openChat">Chat</div>
        </v-flex>
    </v-layout>
</template>

<script>
    import { mapGetters } from 'vuex'
    import Url from './../services/config'

    export default {
        name: "Chat",
        data () {
            return {
                messChat :'',
                items: [],
                myConnection: {}
            }
        },
        methods: {
           sendMessage(){

               let d = new Date()

               let params = {
                 'message' : this.messChat,
                 'action' : 'message',
                 'timestamp' : d.getTime()/1000,
                   'roomId' : this.getParcours.id

               };

               this.myConnection.send(JSON.stringify(params));

               this.messChat="";

           },

           quitChat(){
             /* Cache le chat quand clique sur chat */
             document.querySelector("#conteneurGeneral").className = "chatCache";

             /* Affiche le bouton pour ouvrir le chat*/
             document.querySelector("#btnOpenChat").className = "btnOpen";
           },
           openChat(){
             /* Affiche le chat quand clique sur le bouton */
            document.querySelector("#conteneurGeneral").className = "conteneurGeneral";

            /* Cache le bouton pour ouvrir le chat*/
            document.querySelector("#btnOpenChat").className = "chatCache";
            },

            connection () {

                // je perd la reference de this a partir de then response
                let dataThis = this;
                // connection au serveur chat en websocket
                let conn = new WebSocket('ws://localhost:9090');
                this.myConnection = conn;

                let username = this.getUser.username;
                let userId = this.getUser.id;
                let parcours = this.getParcours.id;


                conn.onopen = function(e) {

                    console.log("Connection established!");

                    let msg = {

                        'roomId': parcours,
                        'userName': username,
                        'userID' : userId,
                        'action': 'connect'

                    };

                    // envoie des données utilisateur au serveur
                    conn.send(JSON.stringify(msg))

                    // Maintenant on peut charger les messages de cette conversation auprès de l'api ?
                    // Pour le début oui, le truc c'est qu'après les mess doivent etre push automatiquement

                    Url.get('/parcours/'+ parcours + '/posts').then(function (response){

                        // Réorganisation des données recues

                        let data = response.data.parcours[0];
                        let posts = data.posts;
                        let users = data.users;

                        posts.forEach(item => {
                            users.forEach(user => {
                                if(item.user_id === user.id){
                                    item.username = user.username
                                }
                            })
                        });

                        dataThis.items = posts
                        console.log(dataThis.items)

                    }).catch(error => {
                        console.log(error)
                    })
                };

               /**
                * Quand on recoit un message
                * on l'ajoute au tableau item
                * @param e
                */
               conn.onmessage = function(e) {
                    let message = JSON.parse(e.data);

                    console.log(message)
                   if (message.type === "user-disconnected"){

                       dataThis.items.push({
                           username: 'admin',
                           message: message.message
                       })

                   } else if(message.from !== 'undefined'){
                        dataThis.items.push({
                            username: message.from.name,
                            message: message.message
                        })
                    }


                };
            }
        },
        computed: {
            ...mapGetters(['getUser','getParcours'])
        },
        mounted () {
            this.connection()
        },
        beforeDestroy () {
            console.log('hello')

            let test = () => {
                this.myConnection.close();
            }

            test()

            console.log('connection fermé')

        }
    }
</script>

<style>
.conteneurGeneral{
   position: fixed;
   bottom: 0px;
   right: 20px;
   z-index: 10;
}
.conteneurChat{
   height :30px;
}
.conteneurMessages{
   height: 350px;
   position: relative;
   overflow-y:scroll;
   padding: 0px 13px;
}
.conteneurAuteur{
   margin-top: 10px;
}
.contenuTxt{
   color:black;
}
.conteneurInput{
   max-height:50px;
   background-color:#595959;
   padding:0px 13px;
   position:relative;
   overflow-y: scroll;
   overflow-x: hidden;
}
.titleChat{
   font-size : 12pt;
   position :absolute;
   top :4px;
}
.auteur{
   font-size : 0.8em;
   color : #DDD;
   margin-bottom: 0px;
}
.leMess{
   background-color: #EEE;
   padding : 10px;
   border-radius: 13pt;
   max-width: 300px;
   height: auto;
}
.plsMess{
   margin-top : 5px;
}
.chatCache{
   display: none;
}
.btnOpen{
 background-color : #039BE5;
 margin-right: 10px;
 padding: 6px 70px;

 position: fixed;
 right:10px;
 bottom: 0px;
 z-index: 1000;
 font-size: 12pt;
 font-weight : 500;
}
</style>
