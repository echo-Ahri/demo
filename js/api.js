// 刚刚封装的axios
import request from './axios';

// 获取图片验证码
export const getImgCode = () => {
    return request({
        url: '/image/code',
        method: 'get',
        // 图片验证码 response类型设置成blob，图片才能显示出来
        responseType: "blob"
    })
}

// 搜索任务接口
export const queryTask = (query1, query2) => {
    return request({
        url: '/task/query',
        method: 'post',
        data: query1,
        params: query2
    })
}

// 1.购物券列表
export const getDrawList = () => {
    return request({
        url: '/api/testvue/getDrawList',
        method: 'post',
    })
}

// 2.抢券
export const robDraw = (query) => {
    return request({
        url: '/api/testvue/robDraw',
        method: 'post',
        data: query,
    })
}