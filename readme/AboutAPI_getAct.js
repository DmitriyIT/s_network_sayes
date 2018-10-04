/*  
 *  Задача: получить активности челенджа и чаты в них
 *  POST запрос: http://sayes.mcdir.ru/api/getactive/[id челенджа]
 *  
 *  email: mit1035@yandex.ru
 *  password: 22
 */

// Формат ответа сервера:
$arrayOut = array(
	'action' => array(
		
	),
	'chat' => array(
		'chat' => array(),
		'author' => array()
	)
);

// Пример ответа на http://sayes.mcdir.ru/api/getactive/2:
{
	action: [
		{
			id: "14",
			name: "first",
			datebrth: "1515428366",
			chl_id: "2",
			authorid: "6"
		},
		{
			id: "19",
			name: "newActd7",
			datebrth: "1515491336",
			chl_id: "2",
			authorid: "6"
		},
		{
			id: "30",
			name: "Пробная для id",
			datebrth: "1516034295",
			chl_id: "2",
			authorid: "6"
		}
	],
	chat: {
		chat: [
			{
				"31": {
					id: "31",
					msg_id_author: "59",
					msg_id_groupe: null,
					msg_text: "еще   1 юзер",
					msg_date: "1527165005",
					active_id: "14"
				},
				"32": {
					id: "32",
					msg_id_author: "49",
					msg_id_groupe: null,
					msg_text: "дада)",
					msg_date: "1527165181",
					active_id: "14"
				},
				"41": {
					id: "41",
					msg_id_author: "49",
					msg_id_groupe: null,
					msg_text: "Бум",
					msg_date: "1528111985",
					active_id: "14"
				},
				"42": {
					id: "42",
					msg_id_author: "63",
					msg_id_groupe: null,
					msg_text: "Hmmmm",
					msg_date: "1528112915",
					active_id: "14"
				},
				"44": {
					id: "44",
					msg_id_author: "64",
					msg_id_groupe: null,
					msg_text: "misha test3",
					msg_date: "1528136673",
					active_id: "14"
				},
				"45": {
					id: "45",
					msg_id_author: "49",
					msg_id_groupe: null,
					msg_text: ")) ",
					msg_date: "1528137134",
					active_id: "14"
				},
				"46": {
					id: "46",
					msg_id_author: "49",
					msg_id_groupe: null,
					msg_text: "как приятно когда кто то начал пользоваться :)))",
					msg_date: "1528137134",
					active_id: "14"
				}
			},
			{
				"36": {
					id: "36",
					msg_id_author: "49",
					msg_id_groupe: null,
					msg_text: "daw",
					msg_date: "1527608304",
					active_id: "19"
				}
			},
			[ ]
		],
		author: [
			[
				{
					id: "59",
					login: null,
					password: "$2y$10$5J62YrMjcTdvGQwcpM3f0u7obu658Sf10oP9xxaldg1kldskQ5DRe",
					email: "mit1135@yadenx.ru",
					age: "",
					imgurl: null,
					fname: "newUser",
					sname: "newUser",
					img_url: null,
					email_connect: "email",
					towm: null,
					town: "город",
					ownRoom_sex: null,
					ownRoom_age: null,
					sex: ""
				},
				{
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
				{
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
				{
					id: "63",
					login: null,
					password: "$2y$10$t1zEwHbizz3H1o5XUbcuiOku16pQnu/mFw6BjeElH0vliJ8K8HhUS",
					email: "tonchizavr@gmail.com",
					age: "Mmmmm",
					imgurl: null,
					fname: "ScratchyWatchy",
					sname: "Watchy",
					img_url: null,
					email_connect: "Tonchizavr@gmail.com",
					towm: null,
					town: "Нск",
					ownRoom_sex: null,
					ownRoom_age: null,
					sex: "M"
				},
				{
					id: "64",
					login: null,
					password: "$2y$10$Hmq1gFPdugWNXQ5me7df4.C8O44BqKTvuhKAN6O4vJb2j/35nkzQO",
					email: "abc@abc.ru",
					age: null,
					imgurl: null,
					fname: "newUser",
					sname: "newUser",
					img_url: null,
					email_connect: "email",
					towm: null,
					town: "город",
					ownRoom_sex: null,
					ownRoom_age: null,
					sex: null
				},
				{
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
				{
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
				}
			],
			[
				{
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
				}
			],
			[ ]
		]
	}
}



