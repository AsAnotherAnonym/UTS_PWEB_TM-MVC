<?php
class Item {
    private $dataFile = __DIR__ . '/../../data/items.json';
    
    public function __construct() {
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([]));
        }
    }
    
    private function getData() {
        return json_decode(file_get_contents($this->dataFile), true) ?? [];
    }
    
    private function saveData($data) {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }
    
    public function getAll() {
        return $this->getData();
    }
    
    public function findById($id) {
        $items = $this->getData();
        foreach ($items as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }
        return null;
    }
    
    public function create($name, $description, $price, $userId) {
        $items = $this->getData();
        
        $newItem = [
            'id' => count($items) + 1,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'user_id' => $userId,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $items[] = $newItem;
        $this->saveData($items);
        return $newItem['id'];
    }
    
    public function update($id, $name, $description, $price) {
        $items = $this->getData();
        
        foreach ($items as $key => $item) {
            if ($item['id'] == $id) {
                $items[$key]['name'] = $name;
                $items[$key]['description'] = $description;
                $items[$key]['price'] = $price;
                $items[$key]['updated_at'] = date('Y-m-d H:i:s');
                $this->saveData($items);
                return true;
            }
        }
        return false;
    }
    
    public function delete($id) {
        $items = $this->getData();
        
        foreach ($items as $key => $item) {
            if ($item['id'] == $id) {
                unset($items[$key]);
                $this->saveData(array_values($items));
                return true;
            }
        }
        return false;
    }
}
?>