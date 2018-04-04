<template>
    <v-flex xs12>
        <p>Ce type d'exercice permet de comparer le code que vous attendez au code que l'utilisateur envoie </p>
        <p>Dans les champs "code" et "code a compléter", écrivez directement le code sans commencer par "<?php"</p>
        <p>Les parties à compléter sont balisée par <strong>[blank]</strong></p>
        <v-form v-model="valid" ref="form" lazy-validation>

            <v-text-field label="Titre" v-model="title_true" required></v-text-field>
            <v-text-field label="description" v-model="description" required></v-text-field>
            <v-text-field label="Code" v-model="codeTrue" :multi-line="line" required></v-text-field>
            <v-text-field label="Code à compléter" v-model="codeFalse" :multi-line="line" required></v-text-field>

            <v-btn @click="submit" :disabled="!valid">Modifier</v-btn>
        </v-form>
    </v-flex>
</template>

<script>
    import Url from './../services/configJwt'
    import { mapGetters } from 'vuex'
    export default {
        name: "ModifyFillIn",
        props: ['title_true','description','type','id'],
        data() {
            return {
                valid: true,
                codeTrue: '',
                codeFalse: '',
                line: true,
                parcours : ""
            }
        },
        methods: {
            submit () {

                Url.post('/connect/exercice/modify',{

                    title : this.title_true,
                    description: this.description,
                    codeTrue : this.codeTrue,
                    codeFalse : this.codeFalse,
                    type : this.type,
                    id : this.id

                }).then(() => {
                    this.$router.push('/parcours/' + this.getParcours.id + '/' + this.getParcours.title)
                }).catch(error => console.log(error))
            }
        },
        computed: {
            ...mapGetters(['getParcours'])
        }
    }
</script>

<style scoped>

</style>