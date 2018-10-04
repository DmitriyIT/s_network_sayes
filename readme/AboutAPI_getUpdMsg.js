/* 
 *  Задача: загрузить новые сообщ в чате
 *  
 *  POST запрос: http://sayes.mcdir.ru/api/getupdchat
 *  email: mit1035@yandex.ru
 *  password: 22
 *  active_id: 14 // id активности для кот подгружаются нов сообщ
 *  msg_last_id: 58  // id посл сообщ в чате
 */

// Формат ответа сервера:
$result = array(
	'msg_last_id' => $msg_last_id,
	'msgs' => array(
		'msgs' => array(),
		'author' => array()
	)
);

// Пример ответа:
{
	msg_last_id: "59",
	msgs: {
		msgs: [
			{
				id: "59",
				msg_id_author: "49",
				msg_id_groupe: null,
				msg_text: "проверка апи_чат",
				msg_date: "1529675640",
				active_id: "14"
			}
		],
		author: [
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
		]
	}
}