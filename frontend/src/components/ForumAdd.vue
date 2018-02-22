<template>
  <div class="containerGeneral">
    <v-layout row wrap>
      <v-flex xs10 offset-xs1>
        <h1 class="text-sm-left">Ajouter un sujet</h1>
      </v-flex>

      <v-flex xs10 offset-xs1>
          <v-text-field  name="input-7-1" label="sujet " multi-line></v-text-field>
      </v-flex>

    </v-layout>
  </div>
</template>

<script>
export default{
  name :'ForumAdd',
  data: () => ({
    sujet: '',
  })
}
</script>

<style scoped>
</style>
