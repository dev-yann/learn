<template>
    <v-container>
        <p>Ce type d'exercice permet de comparer le code que vous attendez au code que l'utilisateur envoie, les parties
            à compléter sont balisée par [blank]</p>
        <v-form v-model="valid" ref="form" lazy-validation>
            <v-text-field
                    label="Titre"
                    v-model="title"
                    required
            ></v-text-field>
            <v-text-field
                    label="description"
                    v-model="description"
                    required
            ></v-text-field>
            <v-text-field
                    label="Code"
                    v-model="codeTrue"
                    :multi-line="line"
                    required
            ></v-text-field>
            <v-text-field
                    label="Code à compléter"
                    v-model="codeFalse"
                    :multi-line="line"
                    required
            ></v-text-field>

            <v-btn
                    @click="submit"
                    :disabled="!valid"
            >
                submit
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
    import url from './../services/config';

    export default {
        name: "fill-in-the-blank-form",
        props: ['e2'],
        data() {
            return {
                valid: true,
                title: '',
                description: '',
                codeTrue: '',
                codeFalse: '',
                line: true
            }
        },
        methods: {
            submit() {
                if (this.$refs.form.validate()) {
                    // Native form submission is not yet supported
                    url.post('/parcours/1/add/fill', {

                        title: this.title,
                        description: this.description,
                        codeTrue: this.codeTrue,
                        codeFalse: this.codeFalse

                    }).then(response => {

                        console.log(response)
                        this.$router.push({path:"/exercices"});

                    }).catch(error => {
                        console.log(error)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>