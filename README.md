# Rpc

## 概念

RPC，远程调用框架（Remote Procedure Call）。

什么是远程调用？

比如 A (client) 调用 B (server) 提供的remoteAdd方法：

    1.首先A与B之间建立一个TCP连接；

    2.A把需要调用的方法名（这里是remoteAdd）以及方法参数（10， 20）序列化成字节流发送出去；

    3.B接受A发送过来的字节流，然后反序列化得到目标方法名，方法参数，接着执行相应的方法调用（可能是localAdd）并把结果30返回；

    4.A接受远程调用结果,输出30。
    
## 远程调用的好处

解耦：当server需要对方法内实现修改时，client完全感知不到，不用做任何变更；这种方式在跨部门，跨公司合作的时候经常用到，并且方法的提供者我们通常称为：服务的暴露。

