<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Monserrat:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
<div id="app">
    <v-app>
    <v-content>
<v-parallax
    height="340"
    src="<?=base_url()?>/assets/background-form.png"
    jumbotron>
  </v-parallax>
    <v-container>
    <v-card style="margin-top: -300px" class="light">
        <v-card-title>
        <div class="headertxt">FORMULIR REGISTRASI PESERTA PPBT BUSINESS CAMP 2019</div>
        </v-card-title>
    <v-form  
        method="get" action=""ref="form"v-model="valid"lazy-validation>
        <v-container >
            <v-layout pa-2 row wrap>

                <v-flex pa-1>
                    <v-text-field
                        name="hallo"
                        v-model="name"
                        :counter="10"
                        :rules="nameRules"
                        label="Name"
                        value="hallo"
                        outline
                        required>
                    </v-text-field>

                    <v-flex pa-1>
                        <div>Kategori Peserta :</div>
                        <v-radio-group v-model="category" row >
                            <v-radio label="Tenant" color="success" value="tenant"></v-radio>
                            <v-radio label="Inkubator" color="success" value="inkubator"></v-radio>
                        </v-radio-group>
                    </v-flex>

                        <v-layout>
                            <v-flex pa-1>
                                <v-text-field
                                    name="tempatLahir"
                                    v-model="tempatLahir"
                                    label="Tempat lahir"
                                    outline
                                    required>
                                </v-text-field>
                            </v-flex>
                            <v-flex pa-1>
                                <v-menu
                                    ref="menu"
                                    v-model="menu"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    lazy
                                    transition="scale-transition"
                                    offset-y
                                    full-width
                                    min-width="290px">
                                    <template v-slot:activator="{ on }">
                                    <v-text-field
                                        v-model="date"
                                        label="Tanggal Lahir"
                                        append-icon="event"
                                        readonly
                                        v-on="on"
                                        outline
                                    ></v-text-field>
                                    </template>
                                    <v-date-picker
                                    ref="picker"
                                    v-model="date"
                                    :max="new Date().toISOString().substr(0, 10)"
                                    min="1950-01-01"
                                    @change="save"
                                    ></v-date-picker>
                                </v-menu>
                            </v-flex>
                        </v-layout>

                        <v-textarea
                            outline
                            name="input-7-4"
                            label="Alamat Peserta"
                        ></v-textarea>

                        <v-text-field
                        name="telp"
                        mask="####-####-####"
                        label="Nomor Telepon / HP"
                        outline
                        required>
                        </v-text-field>


                        <v-text-field
                            name="email"
                            v-model="email"
                            :rules="emailRules"
                            label="Alamat Email"
                            outline
                            required
                        ></v-text-field>
                </v-flex>

        
                <v-flex xs12 sm4 md4 >

                    <template v-if="category === 'tenant'">
                        <v-text-field
                            name="produkYangDihasilkan"
                            v-model="tempatLahir"
                            label="Produk yang dihasilkan"
                            outline
                            required>
                        </v-text-field>

                        <v-text-field
                            name="produkYangDihasilkan"
                            v-model="tempatLahir"
                            label="Nama produk tenant / yang didampingi"
                            outline
                            required>
                        </v-text-field>

                        <v-select
                            v-model="select"
                            :items="items"
                            :rules="[v => !!v || 'Item is required']"
                            label="Nama lembaga inkubator"
                            outline
                            required
                        ></v-select>

                        <v-text-field
                            mask="##.###.###.#-###.###"
                            label="Nomor NPWP"
                            outline>
                        </v-text-field>
                    </template>

                        <v-radio-group pa-2 v-model="radioBayar" >
                            <div pa-1>Metode Pembayaran : </div>
                            <v-layout align-center>
                                <v-radio color="success" value="ditempat"></v-radio>
                                <div class="subheading pa-2">Bayar ditempat</div>
                            </v-layout>

                            <v-layout align-center>
                                <v-radio color="success" value="bayarDisini"></v-radio>
                                    <template>
                                        <v-btn
                                        :disabled="radioBayar === 'ditempat'"
                                        label="Upload bukti pembayaran" 
                                        @click='pickFile' v-model='imageName'
                                        color="blue-grey" class="white--text"
                                        >
                                        Unggah bukti
                                        <v-icon right dark>cloud_upload</v-icon>
                                        
                                        </v-btn>
                                        <input
                                            type="file"
                                            style="display: none"
                                            ref="image"
                                            accept="image/*"
                                            @change="onFilePicked">
                                    </template>
                            </v-layout>  
                            <img :src="imageUrl" height="150" v-if="imageUrl && radioBayar === 'bayarDisini' "/>
                      </v-radio-group>

                </v-flex>
            </v-layout>

            <v-checkbox
                v-model="checkbox"
                :rules="[v => !!v || 'You must agree to continue!']"
                label="Menyatakan bersedia untuk mengikuti seluruh rangkaian
                program pelatihan PPBT Business Camp 2019"
                required
            ></v-checkbox>
                
            <v-btn 
                type="submit"
                :disabled="!valid"
                color="success"
                @click="validate">
                Submit
            </v-btn>

            <v-btn
                color="error"
                @click="reset">
                Reset Form
            </v-btn>
       
        </v-container>
    </v-form>
    </v-card>
    </v-container>
    </v-content>
    </v-app> 
  </div>
</body>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
  <script>

    var example1 = new Vue({
        el: '#app',
        data: () => ({
            // datepicker
            date: null,
            menu: false,

            category: '',

            radioBayar : "ditempat",
            valid: true,
            name: '<?php echo "hallo" ?>',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters'
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            select: null,
            items: [
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4'
            ],
            checkbox: false,
            //image attach
            title: "Image Upload",
            dialog: false,
            imageName: '',
            imageUrl: '',
            imageFile: ''
        }),
        watch: {
            // datepicker
            menu (val) {
                val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
            }
        },

        methods: {
            validate () {
                if (this.$refs.form.validate()) {
                this.snackbar = true
                }
            },
            reset () {
                this.$refs.form.reset()
                this.radioBayar = "ditempat"
            },
            //datepicker
            save (date) {
                this.$refs.menu.save(date)
            },
            //image attach
            pickFile () {
                this.$refs.image.click ()
            },
            onFilePicked (e) {
			const files = e.target.files
			if(files[0] !== undefined) {
				this.imageName = files[0].name
				if(this.imageName.lastIndexOf('.') <= 0) {
					return
				}
				const fr = new FileReader ()
				fr.readAsDataURL(files[0])
				fr.addEventListener('load', () => {
					this.imageUrl = fr.result
					this.imageFile = files[0] // this is an image file that can be sent to server...
				})
			} else {
				this.imageName = ''
				this.imageFile = ''
				this.imageUrl = ''
			}
		}

        }
    })
  </script>

  <style>
    .headertxt{
        padding-top: 100px;
        font-weight: bold;
        font-size: 25px;
        text-align: center;
    }
    .v-card__title{
        background-color: #fafafa;
        display: block;
    }

     input[type='number'] {
    -moz-appearance:textfield;
    }
     input::-webkit-outer-spin-button,
     input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

  </style>
</html>