<template>
  <div
    class="modal fade"
    id="paymentModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Переказ</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-center mb-3">
            <div class="froms">
              <h6>З картки</h6>
              <div class="">
                <Multiselect
                  v-model="fromCardId"
                  placeholder="Виберіть картку"
                  :filterResults="true"
                  :minChars="1"
                  :resolveOnLoad="false"
                  :delay="0"
                  :searchable="true"
                  :options="cards"
                  :valueProp="'id'"
                  :trackBy="'id'"
                  :label="'name'"
                />
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="from">
              <h6>Картка одержувача</h6>
              <div class="mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Введіть номер картки"
                  v-model="toCard"
                />
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <div class="from">
              <h6>Сума</h6>
              <div class="mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="100.00"
                  v-model="total"
                />
              </div>
            </div>
          </div>
          <div v-if="errors?.total" class="text-danger">
            {{ errors?.total[0] }}
          </div>
          <div v-if="isSuccess" class="text-success">Успiшно</div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" @click="send">
              Переказати
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Закрити
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Multiselect from "@vueform/multiselect";

export default {
  name: "Payment",
  components: {
    Multiselect
  },
  computed: {
    ...mapGetters("user", ["userData"])
  },
  data() {
    return {
      cards: [],
      fromCardId: "",
      toCard: "",
      total: "100",
      isSuccess: false,
      errors: {}
    };
  },
  methods: {
    getCards() {
      const userId = this.$route.params.id ?? this.userData.id;

      this.$axios.get(`/users/${userId}/cards`).then(response => {
        this.cards = response.data.data;
      });
    },
    send() {
      this.isSuccess = false;
      this.errors = {};

      this.$axios
        .post("/payments", {
          fromCardId: this.fromCardId,
          toCard: this.toCard,
          description: "Переказ",
          total: this.total
        })
        .then(() => {
          this.isSuccess = true;
        })
        .catch(errors => {
          this.errors = errors.response.data.errors;
          console.log(this.errors);
        });
    }
  },
  mounted() {
    this.getCards();
  }
};
</script>

<style lang="scss">
.froms {
  padding-left: 20px;
}
</style>
