<!-- <CreateButton :id="post.id" :destroy="destroyPost" /> -->

<template>
  <button type="button" class="btn btn-primary btn-sm" @click="edit(id)">
    EDIT
  </button>
  <button type="button" class="btn btn-danger btn-sm" @click="hapus(id)">
    HAPUS
  </button>
</template>

<script>
import { defineComponent } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  props: {
    id: {
      type: Number,
      required: true,
    },
    destroy: {
      type: Function,
      required: true,
    },
  },
  methods: {
    edit(id) {
      Inertia.get(`/posts/${id}/edit`);
    },
    hapus(id) {
      if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
        Inertia.delete(`/posts/${id}`);
      }
    },
  },
  components: { Link },
});
</script>

