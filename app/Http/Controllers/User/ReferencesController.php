<?php
/**
 * В качестве хранения добавленых референций используем сессию в которой храним массив вида:
 * $_SESSION['user']['references']
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferencesController extends Controller {

    /**
     * Сохраняем в сессию добавленую на панель референцию
     * @param Request $request
     */
    public function store(Request $request) {
        // проверяем реквест на получение name
        if ($request->name) {
            // вытаскиваем уже существующие значения из сессии пользователя
            $list = $request->session()->get('user.references');
            // если получили массив, значит в сессии уже есть референеции
            if (is_array($list)) {
                // проверяем, что такой референции у нас нет в сессии
                if (!in_array($request->name, $list)) {
                    // и только если в сессии нет такого значения, добавляем ее в сессию
                    $request->session()->push('user.references', $request->name);
                }
            } else {
                // если никаких значений в сессии нет, смело добавляем новое
                $request->session()->push('user.references', $request->name);
            }
        }
    }

    /**
     * Удаляем из сессии референцию, которую выикнули из панели
     * @param Request $request
     */
    public function remove(Request $request) {
        if ($request->name) {
            // получаем все референции из сессии, которые добавили туда через store
            $list = $request->session()->get('user.references');
            if ($list) {
                // ищем значение равное name который получили из запроса
                $key = array_search($request->name, $list);
                // если ключ найден
                if (false !== $key) {
                    // удаляеем значение из массива, синтакси получения индекса массива user.references.1
                    // тоже самое что если бы ты длелал $_SESSION['user']['references'][1]
                    $request->session()->forget('user.references.' . $key);
                }
            }
        }
    }

    public function reset(Request $request) {
        if ($request->action == 'reset') {
            $request->session()->forget('user.references');
        }
    }
}
