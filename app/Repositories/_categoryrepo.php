<?php 

	namespace App\Repository;
	use app\Entities\Cateogries;
	use Doctrine\ORM\EntityManager;
	 
	class CategoryRepo {
	 
		/**
		 * @var string
		 */
		private $class = 'app\Entities\Categories';
		/**
		 * @var EntityManager
		 */
		private $em;


		public function __construct(EntityManager $em){
			$this->em = $em;
		}

		public function create(Category $Category){
			$this->em->persist($Category);
			$this->em->flush();
		}

		public function update(Category $Category, $data){
			$category->setName($data['name']);
			$this->em->persist($post);
			$this->em->flush();
		}

		public function CategoryOfId($id){
			return $this->em->getRepository($this->class)->findOneBy([
				'id' => $id
			]);
		}

		public function delete(Post $post){
			$this->em->remove($post);
			$this->em->flush();
		}

		/**
		 * create Post
		 * @return Post
		 */
		private function prepareData($data){
			return new Category($data);
		}
	}