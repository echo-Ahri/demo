<?php
/**
 * 上传类
 * 只需要实例化后调用uploadFile()方法
 */
namespace uploads;
 
class Uploads
{
	// 上传路径 ./ 意思是index.php下的当前目录
	protected $path = "./uploads/images/";
	// 允许上传文件最大值 5M 转换成字节
	protected $max_size = 5 * 1024 * 1024;
	// 允许上传文件后缀
	protected $ext = ['jpg', 'jpeg', 'gif', 'png', 'wbmp', 'bmp'];
	// 类型
	protected $mime = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png', 'image/wbmp', 'image/bmpp'];
	// 文件新名字
	protected $new_file_name = '';
 
	// 存放上传文件的原信息，里面有字段：tmp_name,size,name,type,error
	protected $upload_file_array = [];
 
	/**
	 * __construct 构造函数
	 */
	public function __construct($config = [])
	{
		if(isset($config['path']) && $config['path'] != ''){
			$this->path = $config['path'];
		}
		if($this->path){
			// 自动加上日期如20211224/文件夹
			$this->path = $this->path.date('Ymd', time()).'/';
		}
	}
 
	/**
	 * 上传文件
	 * @return array()
	 */
	public function uploadFile()
	{
 
		// 没有设置上传路径
		if(!$this->path){
			return $this->outMessage('文件路径没有设置');
		}
 
		if(!$this->checkPath()){
			return $this->outMessage('文件路径不是目录或者不可写');
		}
 
		if(!$this->getUploadFile()){
			return $this->outMessage('获取上传文件源错误');
		}
 
		if(!$this->checkSize()){
			return $this->outMessage('文件超过指定大小');
		}
 
		if(!$this->checkExt()){
			return $this->outMessage('文件后缀不符合');
		}
 
		if(!$this->checkMime()){
			return $this->outMessage('文件类型不符合');
		}
 
		// 是否通过http post 上传的
		if(!is_uploaded_file($this->upload_file_array['tmp_name'])){
			return $this->outMessage('不是通过指定的HTTP POST 方式上传');
		}
 
		$this->new_file_name = $this->createNewFileName();
 
		// 开始上传
		$is_move_succ = move_uploaded_file($this->upload_file_array['tmp_name'], $this->path.$this->new_file_name);
 
		if(!$is_move_succ){
			return $this->outMessage('移动文件失败，上传失败');
		}
 
		// 上传成功拼接路径
		$pic_path = substr($this->path, 1).$this->new_file_name;
 
		// 获取拼接当前网站域名
		$domain = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
		$result = array(
			'img' => $domain.$pic_path,
			'info' => $pic_path,
			'path' => $_SERVER['DOCUMENT_ROOT'].$pic_path,
			'title' => $this->upload_file_array['name'],
		);
 
		return $this->outMessage('上传成功', true, $result);
 
	}
 
 
 
	/**
	 * 获取上传的文件源
	 * @return [type] [description]
	 */
	public function getUploadFile()
	{
		if(empty($_FILES)) return false;
		foreach($_FILES as $tmp){
			$this->upload_file_array = $tmp;
		}
		return $this->upload_file_array['error']>0? false : true;
	}
 
	/**
	 * 判断文件大小
	 * @return [type] [description]
	 */
	public function checkSize()
	{
		// 判断文件大小
        return $this->upload_file_array['size'] > $this->max_size? false : true;
	}
 
	/**
	 * 判断文件后缀是否符合
	 * @return [type] [description]
	 */
	public function checkExt()
	{
		$old_ext = pathinfo($this->upload_file_array['name'])['extension'];
		return !in_array($old_ext, $this->ext)? false : true;
	}
 
	/**
	 * 判断文件类型是否符合
	 * @return [type] [description]
	 */
	public function checkMime()
	{
		return !in_array($this->upload_file_array['type'], $this->mime)? false : true;
	}
 
	/**
	 * 返回信息
	 * @param  string  $msg    提示
	 * @param  boolean $status 状态：false失败，true成功
	 * @param  [type]  $data   数据
	 * @return [type]          [description]
	 */
	public function outMessage($msg='', $status=false, $data=null)
	{
		return [
			'status' => $status,
			'msg' => $msg,
			'data' => $data
		];
	}
 
	/**
	 * 检查文件夹是否存在和是否有权创建
	 * @return [type] [description]
	 */
	public function checkPath()
	{
		// 文件或目录是否存在
		if( !file_exists($this->path) || !is_dir($this->path) ){
			return mkdir($this->path, 0777, true);
		}
 
		// 检查指定的文件是否可写
		if(!is_writeable($this->path)){
			// 不可写就更改文件权限
			return chmod($this->path, 0777);
		}
		return true;
	}
 
	/**
	 * 创建文件新名字md5 + uniqid + mt_rand生成唯一
	 * @return [type] [description]
	 */
	public function createNewFileName()
	{
		return md5(uniqid(mt_rand(), true)).'.'.pathinfo($this->upload_file_array['name'])['extension'];
	}
 
 
}