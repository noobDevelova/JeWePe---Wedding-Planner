<?php
class ProductController extends Controller
{
    private $productModel;
    public function __construct()
    {
        parent::__construct();
        $this->productModel = $this->loadModel('Product');
    }

    public function index()
    {
        $products = $this->productModel->getAllProduct();
        $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        unset($_SESSION['message']); // Hapus pesan sukses setelah ditampilkan
        $this->render('admin/product/index', ['products' => $products, 'message' => $message]);
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'package_name' => $_POST['package_name'],
                'description' => $_POST['description'],
                'price' => (float) $_POST['price'],
                'status_publish' => $_POST['status_publish'],
                'user_id' => $_SESSION['user_id'],
            ];

            if (!empty($_FILES['package_image']['name'])) {
                $uploadedImage = $this->_do_upload('package_image');
                if ($uploadedImage) {
                    $data['package_image'] = $uploadedImage;
                } else {
                    $_SESSION['message'] = 'Error saat menggungah data';
                    die('Error saat menggungah data');
                }
            }

            $this->productModel->addProduct($data);
            $_SESSION['message'] = 'Berhasil menambahkan data';


            header('Location: index.php?controller=product&action=index');
            exit();
        } else {
            $this->render('admin/product/add');
        }
    }

    public function updateProduct($package_code)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi data yang dikirim melalui formulir
            $data = [
                'package_id' => $_POST['package_id'],
                'package_name' => $_POST['package_name'],
                'description' => $_POST['description'],
                'price' => (float) $_POST['price'],
                'status_publish' => $_POST['status_publish']
            ];

            $product = $this->productModel->getProductByCode($package_code);

            if (!empty($_FILES['package_image']['name'])) {
                $uploadedImage = $this->_do_upload('package_image');
                if ($uploadedImage) {
                    $data['package_image'] = $uploadedImage;

                    if (file_exists('uploads/productImage/' . $product['package_image'])) {
                        unlink('uploads/productImage/' . $product['package_image']);
                    }
                } else {
                    die('Error saat menggungah gambar');
                }
            } else {
                $product = $this->productModel->getProductByCode($package_code);
                $data['package_image'] = $product['package_image'];
            }

            $this->productModel->updateProduct($package_code, $data);

            $_SESSION['message'] = 'Produk berhasil Diperbaharui.';

            // Redirect ke halaman lain setelah update berhasil
            header('Location: index.php?controller=product&action=index');
            exit();
        } else {
            // Mendapatkan data produk
            $product = $this->productModel->getProductByCode($package_code);
            // Merender halaman edit dengan data produk
            $this->render('admin/product/edit', ['product' => $product]);
        }
    }

    public function deleteProduct($package_code)
    {
        if (!empty($package_code)) {

            $product = $this->productModel->getProductByCode($package_code);
            $this->productModel->deleteProduct($package_code);

            if (file_exists('uploads/productImage/' . $product['package_image'])) {
                unlink('uploads/productImage/' . $product['package_image']);
            }

            $_SESSION['message'] = 'Produk berhasil di hapus';

            header('Location: index.php?controller=product&action=index');
            exit();
        } else {
            $_SESSION['message'] = 'Produk tidak ditemukan.';
        }
    }

    private function _do_upload($fileName)
    {
        $upload_dir = 'uploads/productImage/';
        $allowed_types = array('gif', 'jpg', 'jpeg', 'png');

        $file_name = basename($_FILES[$fileName]['name']);
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

        // Validasi tipe file
        if (!in_array(strtolower($file_type), $allowed_types)) {
            return false; // Jika tipe file tidak diperbolehkan
        }

        // Validasi ukuran file
        if ($_FILES[$fileName]['size'] > 5000000) { // Misalnya 5MB
            return false; // Jika ukuran file melebihi batas
        }

        // Generate nama unik untuk file yang diupload
        $new_file_name = uniqid() . '_' . $file_name;

        // Pindahkan file ke direktori upload
        if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $upload_dir . $new_file_name)) {
            return $new_file_name; // Mengembalikan nama file baru
        } else {
            return false; // Jika gagal memindahkan file
        }
    }
}
