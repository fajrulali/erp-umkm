<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref, computed, watch, onMounted } from 'vue'

// Setup form dengan Inertia
const form = useForm({
  email: '',
  password: '',
  remember: false
})

// Validasi Frontend
const emailError = ref('')
const passwordError = ref('')

// Rules validasi
const isValidEmail = computed(() => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email))
const isValidPassword = computed(() => form.password.length >= 8)

// Fungsi validasi input
const validateEmail = () => {
  if (!form.email) emailError.value = 'Email wajib diisi'
  else if (!isValidEmail.value) emailError.value = 'Format email tidak valid'
  else emailError.value = ''
}
const validatePassword = () => {
  if (!form.password) passwordError.value = 'Password wajib diisi'
  else if (!isValidPassword.value) passwordError.value = 'Password minimal 8 karakter'
  else passwordError.value = ''
}

// Watcher untuk jalankan validasi saat user mengetik
watch(() => form.email, validateEmail)
watch(() => form.password, validatePassword)

// Fokus otomatis ke input email saat halaman dibuka
const emailInput = ref(null)
onMounted(() => {
  setTimeout(() => emailInput.value?.focus(), 100)
})

// Handle Login
const handleLogin = () => {
  if (form.processing) return;

  // Cek validasi frontend sebelum submit
  validateEmail()
  validatePassword()
  if (emailError.value || passwordError.value) return;

  // Kirim ke backend
  form.post('/login', {
    preserveScroll: true,
    onError: () => {
      // Tidak perlu update error secara manual, karena sudah otomatis masuk ke form.errors
    }
  })
}
</script>



<template>
  <div class="flex justify-center items-center h-screen">
    <form @submit.prevent="handleLogin" class="w-96 p-6 bg-white shadow rounded fade-in relative">
      <h2 class="text-2xl font-bold mb-4">Login</h2>

      <div class="mb-3">
        <label class="block font-medium">Email</label>
        <input 
          ref="emailInput" 
          v-model="form.email" 
          type="email" 
          class="input-field" 
          :class="{
            'input-field-error': emailError || form.errors.email,
            'input-field-valid': form.email && !emailError && !form.errors.email
          }"
          placeholder="Email"
        />
        <p v-if="emailError || form.errors.email" class="text-red-500 text-sm">
          {{ form.errors.email?.[0] || emailError }}
        </p>
      </div>

      <div class="mb-3">
        <label class="block font-medium">Password</label>
        <input 
          v-model="form.password" 
          type="password" 
          class="input-field" 
          :class="{
            'input-field-error': passwordError || form.errors.password,
            'input-field-valid': form.password && !passwordError && !form.errors.password
          }"
          placeholder="Password"
        />
        <p v-if="passwordError || form.errors.password" class="text-red-500 text-sm">
          {{ form.errors.password?.[0] || passwordError }}
        </p>
      </div>

      <!-- Remember Me (Switch) -->
      <div class="mb-4 flex items-center">
        <label for="remember" class="relative flex items-center cursor-pointer">
          <input 
            id="remember" 
            v-model="form.remember" 
            type="checkbox" 
            class="sr-only peer"
          />
          <div class="w-9 h-5 bg-gray-300 peer-focus:ring-2 peer-focus:ring-blue-400 rounded-full peer-checked:bg-blue-500 peer-checked:after:translate-x-4 after:content-[''] after:absolute after:top-1/2 after:left-[2px] after:-translate-y-1/2 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all"></div>
          <span class="ml-3 text-gray-700">Remember Me</span>
        </label>
      </div>

      <button type="submit" class="btn btn-primary" 
              :class="{ 'btn-loading': form.processing }" 
              :disabled="form.processing">
        <div class="btn-splash" :class="{ 'btn-splash-active': form.processing }"></div>
        <svg v-if="form.processing" class="btn-icon" viewBox="0 0 24 24"></svg>
        <span v-if="!form.processing">Login</span>
      </button>
    </form>
  </div>
</template>

