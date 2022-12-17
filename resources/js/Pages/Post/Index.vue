<template>
  <div class="mt-5">
    <!-- flash message -->
    <div
      v-if="$page.props.flash.message"
      class="alert alert-success"
      role="alert"
    >
      {{ $page.props.flash.message }}
    </div>
    <!-- flash message -->
    <div class="mb-3">
      <Link href="/posts/create" class="btn btn-primary shadow-sm">
        CREATE
      </Link>
    </div>
    <div class="card border-0 rounded shadow-sm">
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">TITLE</th>
              <th scope="col">CONTENT</th>
              <th scope="col">ACTIONS</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="post in $page.props.posts" :key="post.id">
              <td>{{ post.title }}</td>
              <td>{{ post.content }}</td>
              <td>
                <!-- component with data -->
                <CreateButton :id="post.id" :destroy="destroyPost" />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
//import layout
import LayoutApp from "../../Layouts/App.vue";

//import Link dari inertia
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import CreateButton from "../../Component/CreateButton.vue";

export default {
  //layout
  layout: LayoutApp,

  //register Link di component
  components: {
    Link,
    Inertia,
    CreateButton,
  },

  //props
  props: {
    posts: Array, // <- nama props yang dibuat di controller saat parsing data
  },

  //methods
  methods: {
    destroyPost(id) {
      if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
        Inertia.delete("/posts/" + id);
      }
    },
  },
};
</script>

<style>
</style>
