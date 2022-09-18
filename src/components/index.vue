<template>
	<v-row>
		<v-col cols="12">
			<v-data-table dense item-key="arrival_material_id"
				:headers="tableColumn"
				:items="gridData"
				:items-per-page="50"
				:loading="load"
				:search="search"
				:footer-props="{showFirstLastPage: true, firstIcon: 'mdi-arrow-collapse-left', lastIcon: 'mdi-arrow-collapse-right', prevIcon: 'mdi-minus', nextIcon: 'mdi-plus', itemsPerPageOptions: [30, 50, 100, -1], itemsPerPageText: 'Отобразить на странице'}">
				<template v-slot:no-data>
					Пока ничего нет :(
				</template>
			</v-data-table>
		</v-col>
		<v-dialog dense v-model="dialogPrint" max-width="512">
			<v-card>
				<v-card-title>Опись расходных материалов</v-card-title>
				<v-card-subtitle>Формирование описи</v-card-subtitle>
				<v-divider></v-divider>
				<v-card-text>
					<v-row>
						<v-col cols="12">
							<v-autocomplete @update:search-input="locationText" v-model="id_location" :items="dropdownLocation" outlined dense label="Место хранения"></v-autocomplete>
						</v-col>
					</v-row>
				</v-card-text>
				<v-divider></v-divider>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="success" :loading="loadExpenses" @click="printInventory()">ОК</v-btn>
					<v-btn color="error" @click="dialogPrint = false">Отмена</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</v-row>
</template>

<script>

export default {
	data () {
		return {
			search: '',
			tableColumn: [
				{ text: 'Код', align: 'start', sortable: true, value: 'id', width: 60},
				{ text: 'Имя', align: 'start', sortable: true, value: 'name', width: 60},
				{ text: 'Email', align: 'start', sortable: true, value: 'email', width: 60},
				{ text: 'Номер телефона', align: 'start', sortable: true, value: 'phone', width: 60},
			],
			gridData: [],
		}
	},
	methods: {
		getStorage(){
			this.load = true;
			this.$http.get('/api/users').then(response => (this.load = false, this.gridData = response.data)).catch(error => (this.load = false, alert(error.response.data.message)));
		}
	},
	created(){
		this.getStorage();
	}
  }
</script>