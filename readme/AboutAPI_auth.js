/* 
 *  Задача: авторизадия и получение нач данных (челенджи юзера, 
 *  ... далее по id челенджа можно получить и его активности с чатами)
 *  
 *  POST запрос: http://sayes.mcdir.ru/api/authuser
 *  email: mit1035@yandex.ru
 *  password: 22
 */

// Формат ответа сервера:
$arrayOut = array(
	'user' => $user,
	'chls' => $chls
);

// Пример ответа:
{
	user: {
		id: "49",
		login: "ddd",
		password: "$2y$10$t1zEwHbizz3H1o5XUbcuiOku16pQnu/mFw6BjeElH0vliJ8K8HhUS",
		email: "mit1035@yandex.ru",
		age: "aw",
		imgurl: null,
		fname: "Дмитрий",
		sname: "Баранов",
		img_url: "firstimg.jpg",
		email_connect: "mit1035@yandex.ru",
		towm: null,
		town: "Москва",
		ownRoom_sex: null,
		ownRoom_age: null,
		sex: "ddd"
	},
	chls: [
		{
			id: "2",
			name: "chl2",
			imgurl: null,
			discription: "тут будет описание",
			authorid: null,
			datebirth: null
		},
		{
			id: "3",
			name: "chl3",
			imgurl: null,
			discription: "тут будет описание",
			authorid: null,
			datebirth: null
		},
		{
			id: "4",
			name: "Утренние пробежки",
			imgurl: null,
			discription: "фцвфцв",
			authorid: null,
			datebirth: null
		},
		{
			id: "6",
			name: "Новый челендж",
			imgurl: null,
			discription: "Описание",
			authorid: null,
			datebirth: null
		},
		{
			id: "7",
			name: "and",
			imgurl: null,
			discription: "anddld",
			authorid: null,
			datebirth: null
		},
		{
			id: "8",
			name: "kkk",
			imgurl: null,
			discription: "o;kl",
			authorid: null,
			datebirth: null
		},
		{
			id: "16",
			name: "Планирование",
			imgurl: "",
			discription: "заранее обдумывать свой досуг и иметь несколько вариантов ",
			authorid: null,
			datebirth: null
		}
	]
}