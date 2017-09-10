Wymagania :
- bcmath
- allow_url_fopen (domyślnie do pobrania contentu strony , w adapterze FileGetsAdapter)

Opis
* Skrypt tworzy raport na podstawie dwóch podanych stron wikipedii.
* Raport tworzony jest już w momencie parsowania contentu strony.
* Najpierw parsowana jest jedna strona - wyniki są buforowane w obiekcie raportu.
* Parsowanie drugiej strony "dokłada" następne wartości do zwróconego wcześniej obiektu raportu.
* Możemy wygenerować też częściowy raport bazujący tylko na contencie z jednego linku.
* Kolejność parsowania stron nie ma znaczenia.
* Za wyświetlenie raportu odpowiadają renderery. Na ten moment stworzony został jeden renderer , wyświetlający raport w przeglądarce.
