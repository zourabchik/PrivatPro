<template>
  <div
    class="modal fade"
    id="editModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Загальна інформація
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Прізвище:</label
            >
            <input
              type="text"
              class="form-control"
              :class="errors?.lastName ? 'is-invalid' : null"
              id="surname"
              :placeholder="user?.lastName"
              v-model="formData.lastName"
            />
            <div class="invalid-feedback">
              {{ errors?.lastName?.[0] }}
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Ім`я:</label
            >
            <input
              type="text"
              class="form-control"
              :class="errors?.firstName ? 'is-invalid' : null"
              id="name"
              :placeholder="user?.firstName"
              v-model="formData.firstName"
            />
            <div class="invalid-feedback">
              {{ errors?.firstName?.[0] }}
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"
              >По батькові:</label
            >
            <input
              type="text"
              class="form-control"
              :class="errors?.middleName ? 'is-invalid' : null"
              id="second_name"
              :placeholder="user?.middleName"
              v-model="formData.middleName"
            />
            <div class="invalid-feedback">
              {{ errors?.middleName?.[0] }}
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Дата народження:</label
            >
            <input
              type="text"
              class="form-control"
              :class="errors?.birth ? 'is-invalid' : null"
              id="birth"
              :placeholder="user?.birth"
              v-model="formData.birth"
            />
            <div class="invalid-feedback">
              {{ errors?.birth?.[0] }}
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Номер телефону:</label
            >
            <input
              type="text"
              class="form-control"
              :class="errors?.phone ? 'is-invalid' : null"
              id="tel"
              :placeholder="user?.phone"
              v-model="formData.phone"
            />
            <div class="invalid-feedback">
              {{ errors?.phone?.[0] }}
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Email:</label
            >
            <input
              type="text"
              class="form-control"
              :class="errors?.email ? 'is-invalid' : null"
              id="email"
              :placeholder="user?.email"
              v-model="formData.email"
            />
            <div class="invalid-feedback">
              {{ errors?.email?.[0] }}
            </div>
          </div>
          <div v-if="isSuccess" class="text-success">
            Дані успішно оновлені.
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary me-2" @click="update">
              Зберегти
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
export default {
  name: "Edit",
  props: {
    user: Object,
  },
  data() {
    return {
      isSuccess: false,
      formData: {
        lastName: this.user?.lastName,
        firstName: this.user?.firstName,
        middleName: this.user?.middleName,
        birth: this.user?.birth,
        phone: this.user?.phone,
        email: this.user?.email,
      },
      errors: {},
    };
  },
  methods: {
    setUserData() {
      if (this.user) {
        this.formData = this.user;
        this.formData.userId = this.$route.params.id;
      }
    },
    update() {
      const formData = this.formData;

      this.errors = {};
      this.$axios
        .put("/profile", formData)
        .then(() => {
          this.isSuccess = true;
        })
        .catch((errors) => {
          if (errors.response.data?.errors) {
            this.errors = errors.response.data?.errors;
          }
        });
    },
  },
  updated() {
    this.setUserData();
  },
};
</script>
