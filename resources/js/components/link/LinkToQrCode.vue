<template>
    <div>

        <vue-qrcode
            type="image/png"
            :color="{ dark: '#000000', light:'#ffffff' }"
            :value="qrData"
            v-if="qrData"
        />

    </div>
</template>

<script>
import VueQrcode from 'vue-qrcode'

export default {
    components: {
        VueQrcode
    },
    data() {
        return {
            qrData: null
        }
    },
    methods: {
        generateQrCode() {
            axios.get('/api/qr-code/init-link').then((res, rej) => {
                this.qrData = JSON.stringify(res.data)
            })
        }
    },
    created() {
        this.generateQrCode();
    }
}
</script>
